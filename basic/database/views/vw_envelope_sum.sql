Create Or Replace View vw_envelope_sum
    As Select E.Id EnvelopeId
        , Case When A.IsCash= 1 Then 0.00 Else Sum(IFNULL(Tran.Amount, 0.0)) End EnvelopeSum
        , Case When A.IsCash= 1 Then 0.00 Else Sum(IFNULL(Tran.Pending, 0.0)) End EnvelopePending
        , fn_calculate_envelope_stats_cost(E.Id) as StatsCost
        , fn_calculate_envelope_stats_length(E.Id) As TimeLeft
        , fn_calculate_envelope_goal_deposit(E.Id) as GoalDeposit
    From `account` A
    Inner Join `envelope` E
        On A.Id = E.AccountId
            And A.IsDeleted = 0
            And E.IsDeleted = 0
    Inner Join `transaction` Tran
        On E.Id = Tran.EnvelopeId
            And Tran.IsDeleted = 0
    Group By E.Id;
