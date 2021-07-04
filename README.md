##assignment:
Implement an installment service which create installments for one order.

Tips:
- Order: Can have at least one order item.
- Period: Repayment in installments, can have 3-12 installments (Preferred payment term of 3, 6, 9 or 12 months.)
- Interest: interest can be saved per stores in database and can be changes every time. You must used store's interest when installment generates.
- Installment: every installment has some details. installment price equals to sum of installment detail prices. We have 2 fix installment details for the first installment (Delivery price & VAT price).
- Delivery and VAT prices equal to 10000.
- Installment detail: you must calculate price with order item price, store interest and month count

Hint:
- Order model: user_id, status, total_quantity, total_price
- Order item model: order_id, store_id, quantity, price, month_count
- Installment model: order_id, total_price, period_date, turn(1-12), status, paid_at
- Installment detail model: installment_id, installment_type (main, vat, delivery), price, store_id
<br/>

### Data model based on the hint:

<div align="center">

![original-er](public/o-lendo.png?raw=true "original-er")

</div>

<br/>

### But I used this Data model for solution:

<div align="center">

![my-er](public/m-lendo.png?raw=true "my-er")

</div>
