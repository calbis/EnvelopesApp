CREATE FUNCTION [dbo].[fnCalculateEnvelopeStatsLength]
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

	Declare @statsCost decimal(19, 2);
	Select @statsCost = dbo.fnCalculateEnvelopeStatsCost(@envelopeId, @userId);

	Declare @retVal decimal(19, 2);
	
	Select @retVal = 	
	(
		Select Case When @statsCost = 0 Then
			0
		Else
		(
			Select Top 1
			ISNULL
			(
				(
					Select (UE.PendingSum + UE.AmountSum) / @statsCost
				)
			, 0.0)
			From vwUserEnvelopes UE
			Where UE.EnvelopeId = @envelopeId
				And UE.UserId = @userId
		)
		End
	);

	RETURN @retVal;
END