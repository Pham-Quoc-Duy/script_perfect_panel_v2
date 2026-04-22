<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy hoặc tạo user mẫu
        $users = User::limit(5)->pluck('id')->toArray();
        if (empty($users)) {
            $this->command->warn('Không có user nào. Hãy chạy UserSeeder trước.');
            return;
        }
        $adminId = $users[0];

        // ---- 1. Ticket Subjects ----
        $subjects = [
            ['category' => 'Thanh toán', 'subcategory' => 'Nạp tiền',        'sort_order' => 1],
            ['category' => 'Thanh toán', 'subcategory' => 'Hoàn tiền',       'sort_order' => 2],
            ['category' => 'Dịch vụ',   'subcategory' => 'Đặt hàng',        'sort_order' => 3],
            ['category' => 'Dịch vụ',   'subcategory' => 'Hủy đơn',         'sort_order' => 4],
            ['category' => 'Kỹ thuật',  'subcategory' => 'Lỗi hệ thống',    'sort_order' => 5],
            ['category' => 'Kỹ thuật',  'subcategory' => 'API',              'sort_order' => 6],
            ['category' => 'Tài khoản', 'subcategory' => 'Đổi mật khẩu',    'sort_order' => 7],
            ['category' => 'Tài khoản', 'subcategory' => 'Xác minh',        'sort_order' => 8],
            ['category' => 'Khác',      'subcategory' => null,               'sort_order' => 9],
        ];

        $subjectIds = [];
        foreach ($subjects as $s) {
            $id = DB::table('ticket_subjects')->insertGetId(array_merge($s, [
                'show_message_only' => false,
                'required_fields'   => null,
                'status'            => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]));
            $subjectIds[] = $id;
        }

        // ---- 2. Tickets + Replies ----
        $ticketData = [
            [
                'user_idx'   => 0,
                'subject_idx'=> 0,
                'subject'    => 'Tôi đã nạp tiền nhưng chưa thấy cộng vào tài khoản',
                'message'    => 'Mình đã chuyển khoản 200k lúc 10:30 sáng nay nhưng số dư vẫn chưa được cập nhật. Mã giao dịch: TXN20240115001.',
                'status'     => 'open',
                'priority'   => 'high',
                'replies'    => [
                    ['is_admin' => false, 'msg' => 'Mình đã chuyển khoản 200k lúc 10:30 sáng nay nhưng số dư vẫn chưa được cập nhật. Mã giao dịch: TXN20240115001.'],
                    ['is_admin' => true,  'msg' => 'Chào bạn, chúng tôi đã nhận được yêu cầu. Vui lòng cung cấp ảnh chụp màn hình giao dịch để chúng tôi xác minh nhanh hơn.'],
                    ['is_admin' => false, 'msg' => 'Đây là ảnh chụp màn hình giao dịch của mình (đã gửi qua email). Mong được hỗ trợ sớm.'],
                    ['is_admin' => true,  'msg' => 'Cảm ơn bạn. Chúng tôi đã xác nhận giao dịch và đang xử lý cộng tiền. Vui lòng chờ trong 15-30 phút.'],
                ],
            ],
            [
                'user_idx'   => 1,
                'subject_idx'=> 2,
                'subject'    => 'Đơn hàng #12345 chạy quá chậm',
                'message'    => 'Đơn hàng của mình đã đặt từ hôm qua nhưng tiến độ chỉ mới 10%. Dịch vụ có vấn đề gì không?',
                'status'     => 'answered',
                'priority'   => 'medium',
                'replies'    => [
                    ['is_admin' => false, 'msg' => 'Đơn hàng của mình đã đặt từ hôm qua nhưng tiến độ chỉ mới 10%. Dịch vụ có vấn đề gì không?'],
                    ['is_admin' => true,  'msg' => 'Xin lỗi vì sự bất tiện này. Hiện tại dịch vụ đang có tải cao hơn bình thường. Đơn hàng của bạn sẽ được xử lý trong 2-4 giờ tới.'],
                    ['is_admin' => false, 'msg' => 'Ok mình hiểu rồi, cảm ơn bạn đã phản hồi.'],
                ],
            ],
            [
                'user_idx'   => 2,
                'subject_idx'=> 4,
                'subject'    => 'Lỗi 500 khi gọi API đặt hàng',
                'message'    => 'API endpoint /api/v2/order trả về lỗi 500 Internal Server Error. Mình đã kiểm tra key và format đúng rồi.',
                'status'     => 'open',
                'priority'   => 'high',
                'replies'    => [
                    ['is_admin' => false, 'msg' => 'API endpoint /api/v2/order trả về lỗi 500 Internal Server Error. Mình đã kiểm tra key và format đúng rồi.'],
                    ['is_admin' => false, 'msg' => 'Đây là request mẫu: {"service":1,"link":"https://...","quantity":100}. Mình đã thử nhiều lần vẫn lỗi.'],
                    ['is_admin' => true,  'msg' => 'Chúng tôi đã ghi nhận lỗi. Đây là vấn đề từ phía server, team kỹ thuật đang xử lý. Dự kiến fix trong 1-2 giờ.'],
                ],
            ],
            [
                'user_idx'   => isset($users[3]) ? 3 : 0,
                'subject_idx'=> 6,
                'subject'    => 'Không đăng nhập được tài khoản',
                'message'    => 'Mình nhập đúng mật khẩu nhưng vẫn báo sai. Đã thử reset password nhưng không nhận được email.',
                'status'     => 'closed',
                'priority'   => 'medium',
                'replies'    => [
                    ['is_admin' => false, 'msg' => 'Mình nhập đúng mật khẩu nhưng vẫn báo sai. Đã thử reset password nhưng không nhận được email.'],
                    ['is_admin' => true,  'msg' => 'Chào bạn, email reset password đôi khi vào thư mục spam. Bạn vui lòng kiểm tra lại nhé. Nếu vẫn không nhận được, hãy cho chúng tôi biết email đăng ký.'],
                    ['is_admin' => false, 'msg' => 'Mình đã kiểm tra spam rồi nhưng không thấy. Email đăng ký là user@example.com'],
                    ['is_admin' => true,  'msg' => 'Chúng tôi đã gửi lại email reset password. Vui lòng kiểm tra trong 5 phút. Nếu vẫn không nhận được hãy liên hệ lại.'],
                    ['is_admin' => false, 'msg' => 'Đã nhận được rồi, cảm ơn bạn nhiều!'],
                    ['is_admin' => true,  'msg' => 'Tuyệt vời! Chúc bạn sử dụng dịch vụ vui vẻ. Ticket này sẽ được đóng lại.'],
                ],
            ],
            [
                'user_idx'   => isset($users[4]) ? 4 : 1,
                'subject_idx'=> 1,
                'subject'    => 'Yêu cầu hoàn tiền đơn hàng bị lỗi',
                'message'    => 'Đơn hàng #98765 bị lỗi và không hoàn thành nhưng tiền vẫn bị trừ. Mình muốn được hoàn lại.',
                'status'     => 'open',
                'priority'   => 'high',
                'replies'    => [
                    ['is_admin' => false, 'msg' => 'Đơn hàng #98765 bị lỗi và không hoàn thành nhưng tiền vẫn bị trừ. Mình muốn được hoàn lại.'],
                ],
            ],
        ];

        foreach ($ticketData as $td) {
            $userId    = $users[$td['user_idx']] ?? $users[0];
            $subjectId = $subjectIds[$td['subject_idx']];
            $now       = now();

            $ticketId = DB::table('tickets')->insertGetId([
                'user_id'       => $userId,
                'domain'        => request()->getHost() ?: 'localhost',
                'subject_id'    => $subjectId,
                'subject'       => $td['subject'],
                'message'       => $td['message'],
                'custom_fields' => null,
                'status'        => $td['status'],
                'priority'      => $td['priority'],
                'last_reply_at' => $now,
                'assigned_to'   => $td['status'] !== 'open' ? $adminId : null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            foreach ($td['replies'] as $i => $r) {
                $replyUserId = $r['is_admin'] ? $adminId : $userId;
                DB::table('ticket_reply')->insert([
                    'ticket_id'  => $ticketId,
                    'user_id'    => $replyUserId,
                    'message'    => $r['msg'],
                    'is_admin'   => $r['is_admin'],
                    'is_system'  => false,
                    'attachments'=> null,
                    'read_at'    => $r['is_admin'] ? null : $now,
                    'created_at' => $now->copy()->addMinutes($i * 5),
                    'updated_at' => $now->copy()->addMinutes($i * 5),
                ]);
            }
        }

        $this->command->info('Đã tạo ' . count($subjectIds) . ' ticket subjects, ' . count($ticketData) . ' tickets với replies mẫu.');
    }
}
