Drop Function If Exists fn_calculate_envelope_stats_length;

Delimiter $$

Create Function fn_calculate_envelope_stats_length
(
	envelopeId int
)
Returns Decimal(19, 2)
Not Deterministic
Begin
    Declare lengt int;
    Select U.StatsLength
    Into lengt
    From Users U
    Where U.Id = 1;

    Declare display varchar(1);
    Select U.StatsDisplay
    Into display
    From Users U
    Where U.Id = 1;

    Declare dat date;
    Select Case When display = 'm' Then DATEADD (MONTH, lengt * -1, GETDATE()) Else DATEADD (DAY, lengt * -7, GETDATE()) End Into dat;

--     Declare statsCost decimal(19, 2);
--     --Select fnCalculateEnvelopeStatsCost(envelopeId) Into statsCost;
--     Select 100 Into statsCost;
-- 
     Declare retVal decimal(19, 2);
Set retVal = 3.55;
-- 
--     Select retVal = 	
--     (
--             Select Case When statsCost = 0 Then
--                     0
--             Else
--             (
--                     Select Top 1
--                     ISNULL
--                     (
--                             (
--                                     Select (UE.PendingSum + UE.AmountSum) / statsCost
--                             )
--                     , 0.0)
--                     From vwUserEnvelopes UE
--                     Where UE.EnvelopeId = envelopeId
--                             And UE.UserId = userId
--             )
--             End
--     );
-- 
     RETURN retVal;
End $$

Delimiter ;