<!-- Simple delete confirmation like category -->
<script>
// Delete payment function - matches category pattern exactly
function deletePayment(id) {
    if (confirm('Bạn có chắc chắn muốn xóa tài khoản thanh toán này không?')) {
        $.ajax({
            url: `/admin/payments/${id}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showToast('success', 'Tài khoản thanh toán đã được xóa thành công!');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function() {
                showToast('error', 'Có lỗi xảy ra khi xóa tài khoản thanh toán');
            }
        });
    }
}
</script>