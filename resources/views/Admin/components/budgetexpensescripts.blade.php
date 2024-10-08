
<script>
    function calculateTotal(input) {
        const row = input.closest('tr');
        const qty = row.querySelector('.qty').value || 0;
        const unitPrice = row.querySelector('.unit-price').value || 0;
        const totalAmount = row.querySelector('.total-amount');

        totalAmount.value = (qty * unitPrice).toFixed(2);
    }

    function addExpenseRow() {
        const tableBody = document.querySelector('#additional-expenses-table tbody');
        const rowCount = tableBody.rows.length;
        const newRow = `
            <tr>
                <td>
                    <input type="number" class="form-control qty" name="additional_expenses[${rowCount}][quantity]" placeholder="Enter quantity" min="0" step="1" oninput="calculateTotal(this)">
                </td>
                <td>
                    <input type="text" class="form-control" name="additional_expenses[${rowCount}][description]" placeholder="Enter description">
                </td>
                <td>
                    <input type="number" class="form-control unit-price" name="additional_expenses[${rowCount}][unit_price]" placeholder="Enter unit price" min="0" step="0.01" oninput="calculateTotal(this)">
                </td>
                <td>
                    <input type="text" class="form-control total-amount" name="additional_expenses[${rowCount}][total_amount]" placeholder="Total" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-expense-btn" onclick="removeExpenseRow(this)">Remove</button>
                </td>
            </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', newRow);
    }

    function removeExpenseRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
</script>
