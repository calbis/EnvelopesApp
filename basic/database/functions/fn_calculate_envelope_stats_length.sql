Drop Function If Exists fn_calculate_envelope_stats_length;

Delimiter $$

Create Function fn_calculate_envelope_stats_length
(
	envelopeId int
)
Returns Decimal(19, 2)
Begin
    Select StatsLength
    Into @length
    From `user`
    Where Id = 1
    Limit 1;

    Select DATE_ADD(CURDATE(), INTERVAL @length * -1 MONTH) Into @date;

    Select fn_calculate_envelope_stats_cost(envelopeId) Into @statsCost;

    Select Case When @statsCost = 0 Then
        0.00
    Else
    (
        Select
            IFNULL
            (
                (
                    Select (Sum(T.Amount) + Sum(T.Pending)) / @statsCost
                )
            , 0.00)
        From `envelope` E
        Inner Join `transaction` T
            On E.Id = T.EnvelopeId
                And E.Id = envelopeId
                And T.IsDeleted = 0
        Group By E.Id
    )
    End
    Into @retVal;


    RETURN @retVal;
End $$

Delimiter ;