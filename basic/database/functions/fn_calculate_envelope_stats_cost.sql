CREATE FUNCTION [dbo].[fnCalculateEnvelopeStatsCost]
(
	@envelopeId int,
	@userId int
)
RETURNS Decimal(19, 2)
AS
BEGIN
	Declare @length int;
	Select @length = 
	(
		Select U.StatsLength
		From Users U
		Where U.Id = @userId
	);
	Declare @display varchar(1);
	Select @display = 
	(
		Select U.StatsDisplay
		From Users U
		Where U.Id = @userId
	);

	Declare @date date;
	Select @date = Case When @display = 'm' Then DATEADD (MONTH, @length * -1, GETDATE()) Else DATEADD (DAY, @length * -7, GETDATE()) End;

	Declare @retVal decimal(19, 2);
	
	Select @retVal = 	
	(
		Select Top 1
		ISNULL
		(
			(
				Case When UE.CalculationType = 'fix' 
				Then UE.CalculationAmount 
				Else
					(
						Select (ISNULL(Sum(T.Amount), 0.0) + ISNULL(Sum(T.Pending), 0.0)) / @length * -1
						From Transactions T
						Where T.EnvelopeId = UE.EnvelopeId
							And T.PostedDate > @date
							And T.UseInStats = 1
							And T.IsDeleted = 0
							And 
							(
								T.Amount < 0
								Or T.IsRefund = 1
								Or T.Pending < 0
							)
						Group By T.EnvelopeId
					)
				End
			)
		, 0.0)
		From vwUserEnvelopes UE
		Where UE.EnvelopeId = @envelopeId
			And UE.UserId = @userId
	);

	RETURN @retVal;
END
