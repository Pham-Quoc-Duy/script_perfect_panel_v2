<!-- Simple delete confirmation like category -->
<script>
// Delete payment method function - matches category pattern exactly
function deletePaymentMethod(id) {
    if (confirm('Bạn có chắc chắn muốn xóa phương thức thanh toán này không?')) {
        $.ajax({
            url: `/admin/payment-methods/${id}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showToast('success', 'Phương thức thanh toán đã được xóa thành công!');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function() {
                showToast('error', 'Có lỗi xảy ra khi xóa phương thức thanh toán');
            }
        });
    }
}
</script>