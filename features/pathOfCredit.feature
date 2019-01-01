 Feature: path of credit - 4 days
    As client
    I take out a loan and pay part of it

    Scenario:
      Given loan in the amount of "1700", commission "466.65", currency "PLN" date "l, 2018-01-01 12:00:00 T", daily interest "0.45"
      When the customer pays a loan in the amount of "1000" currency "PLN" on "l, 2018-01-03 12:00:05 T"
      Then the charges for the date "l, 2018-01-03 12:00:05 T" are "1167.55"
      Then the charges for the dates "l, 2018-01-02 12:00:05 T", "l, 2018-01-04 12:00:05 T" are "2167.10" and "1168"
