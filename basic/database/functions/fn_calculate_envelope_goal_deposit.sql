CREATE FUNCTION [dbo].[fnCalculateEnvelopeGoalDeposit]
(
	@envelopeId int,
	@userId int
)
RETURNS Decimal(19, 2)
AS
BEGIN
	Declare @goal int;
	Select @goal = 
	(
		Select U.GoalLength
		From Users U
		Where U.Id = @userId
	);


	Declare @retVal decimal(19, 2);
	
	Select @retVal = 	
	(
		Select Top 1
		ISNULL
		(
			(
				Select (@goal * (dbo.fnCalculateEnvelopeStatsCost(@envelopeId, @userId)) - UE.AmountSum - UE.PendingSum)
			)
		, 0.0)
		From vwUserEnvelopes UE
		Where UE.EnvelopeId = @envelopeId
			And UE.UserId = @userId
	);

	Select @retVal = 
	(
		Select Case When @retVal < 0 Then	
			0.0
		Else
			@retVal
		End
	);

	RETURN @retVal;
END
