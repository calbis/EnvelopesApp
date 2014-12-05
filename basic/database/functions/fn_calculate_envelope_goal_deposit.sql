Drop Function If Exists fn_calculate_envelope_goal_deposit;

Delimiter $$


CREATE FUNCTION fn_calculate_envelope_goal_deposit
(
	envelopeId int
)
RETURNS Decimal(19, 2)
BEGIN
    Select U.GoalLength
    Into @goal
    From `user` U
    Where U.Id = 1;
	
    Select IFNULL
    (
        (
                Select (@goal * (fn_calculate_envelope_stats_cost(envelopeId)) - SUM(T.Amount) - Sum(T.Pending))
        )
    , 0.0)
    Into @retVal
    From `envelope` E
    Inner Join `transaction` T
        On E.Id = T.EnvelopeId
            And E.Id = envelopeId
            And T.IsDeleted = 0
    Group By E.Id;

    Select Case When @retVal < 0 Then	
        0.0
    Else
        @retVal
    End
    Into @retVal;

    RETURN @retVal;
END
