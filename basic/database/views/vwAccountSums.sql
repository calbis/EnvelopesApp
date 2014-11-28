

Create Or Replace View vwAccountSums As
    Select A.Id AccountId
        , Case When A.IsCash= 1 Then 0.00 Else Sum(IFNULL(Tran.Amount, 0.0)) End AmountSum
        , Case When A.IsCash= 1 Then 0.00 Else Sum(IFNULL(Tran.Pending, 0.0)) End PendingSum
    From `account` A
    Inner Join `envelope` E
        On A.Id = E.AccountId
            And A.IsDeleted = 0
            And E.IsDeleted = 0
    Inner Join `transaction` Tran
        On E.Id = Tran.EnvelopeId
            And Tran.IsDeleted = 0
    Group By A.Id;