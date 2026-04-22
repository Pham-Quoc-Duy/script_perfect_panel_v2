@extends('clients.theme-default.layouts.app')

@section('title', __('tickets.title'))

@section('content')

    <!-- Main variables *content* -->
    <div id="block_51">
        <div class="block-bg"></div>
        <div class="container">
            <div class="ticket-form">
                <div class="row ticket-form__alignment">
                    <div class="col-lg-12">
                        <div class="component_card">
                            <div class="card">
                                <form class="component_form_group" method="post"
                                    action="{{ route('clients.tickets.store') }}" id="ticketsend">
                                    @csrf
                                    <div class="">
                                        <div class="alert alert-dismissible alert-danger ticket-danger"
                                            style="display: none; margin-bottom: 20px;">
                                            <button type="button" class="close">×</button>
                                            <div style="word-break: break-word; line-height: 1.6;"></div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-group">
                                            <label for="ticket-category-field" class="control-label">{{ __('tickets.category') }}</label>
                                            <select id="ticket-category-field" name="category" class="form-control">
                                            </select>
                                        </div>
                                        <div id="ticket-fields" data-ticket-fields="true">
                                            <div class="form-group" id="subcategory-group">
                                                <label class="control-label" for="ticket-subcategory">{{ __('tickets.subcategory') }}</label>
                                                <select class="form-control" name="subcategory" id="ticket-subcategory">
                                                </select>
                                            </div>
                                            <div id="ticket-subcategory-fields"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('tickets.message') }}</label>
                                            <textarea class="form-control" rows="7" name="message"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="tickets-uploader" data-rtl="false"
                                                data-lang-button-attach="{{ __('tickets.attach_files') }}"
                                                data-lang-file-format-incorrect="Invalid file format"
                                                data-lang-file-size-incorrect="File is too large (limit 5 MB)">
                                                <input type="file" id="files-input" multiple=""
                                                    accept="image/jpg,image/jpeg,image/png,image/gif,text/plain,text/csv,application/pdf"
                                                    style="display: none;">
                                                <div class="files-wrapper"><button type="button" id="uploader-button"
                                                        style="background: none;display: flex;align-items: center;align-self: flex-start;padding: 0;border: none;">
                                                        <a href="#" onclick="event.preventDefault()" class="paperclip"
                                                            style="display: flex;align-items: center;justify-content: center;">
                                                            <svg width="24px" height="24px" fill="currentColor"
                                                                viewBox="0 0 24 24" version="1.1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                <title>paperclip</title>
                                                                <g id="paperclip" stroke="none" stroke-width="1"
                                                                    fill-rule="evenodd">
                                                                    <path
                                                                        d="M15.4604059,6.38639442 C14.683645,5.60296995 13.4230004,5.60296995 12.6462396,6.38639442 L6.78869877,12.2941855 C5.44846797,13.6459138 5.44846797,15.8356494 6.78869877,17.1873777 C8.12892957,18.539106 10.3000398,18.539106 11.6402706,17.1873777 L16.4791086,12.3070285 C16.8261043,11.9570561 17.3927577,11.9570561 17.7397533,12.3070285 C18.0867489,12.657001 18.0867489,13.2285155 17.7397533,13.5784879 L12.9009152,18.4588371 C10.8635097,20.513721 7.56545961,20.513721 5.52805412,18.4588371 C3.49064863,16.4039532 3.49064863,13.07761 5.52805412,11.0227261 L11.3855949,5.11493503 C12.8595304,3.62835499 15.247115,3.62835499 16.7210505,5.11493503 C18.1949861,6.60151508 18.1949861,9.0095821 16.7210505,10.4961621 L11.1181854,16.1470928 C10.2077199,17.065369 8.73060088,17.065369 7.8201353,16.1470928 C6.90966972,15.2288165 6.90966972,13.7390257 7.8201353,12.8207495 L12.4042977,8.19726082 C12.7512933,7.84728842 13.3179467,7.84728842 13.6649423,8.19726082 C14.0119379,8.54723323 14.0119379,9.11874781 13.6649423,9.46872021 L9.08077994,14.0922089 C8.86748906,14.3073296 8.86748906,14.6605127 9.08077994,14.8756334 C9.29407083,15.090754 9.6442499,15.090754 9.85754079,14.8756334 L15.4604059,9.22470275 C16.2371667,8.44127828 16.2371667,7.16981889 15.4604059,6.38639442 Z"
                                                                        id="Path" fill-rule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        <span style="margin: 0px 8px" class="files-label">{{ __('tickets.attach_files') }}</span>
                                                    </button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="component_button_submit">
                                        <div class="">
                                            <button class="btn btn-block btn-big-primary" type="submit">
                                                {{ __('tickets.submit_ticket') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="block_59">
        <div class="block-bg"></div>
        <div class="container">
            <div class="tickets-list">
                <div class="row tickets-list__alignment">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="tickets-list__margin-search component_card">
                                    <div class="card">
                                        <div class="component_form_group">
                                            <div class="">
                                                <form action="/tickets" method="get" id="history-search">
                                                    <div class="input-group">
                                                        <input type="text" name="search" class="form-control"
                                                            value="" placeholder="{{ __('newOrder.search') }}">
                                                        <div class="input-group-append component_button_search">
                                                            <button class="btn btn-big-secondary" type="submit">
                                                                <span class="fas fa-search"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="tickets-list__margin-table">
                                    <div class="table-bg component_table ">
                                        <div class="table-wr table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('tickets.ticket_id') }}</th>
                                                        <th>{{ __('tickets.subject') }}</th>
                                                        <th>{{ __('tickets.status') }}</th>
                                                        <th class="nowrap">{{ __('tickets.last_update') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($tickets as $ticket)
                                                        <tr>
                                                            <td>{{ $ticket->id }}</td>
                                                            <td>
                                                                <a href="/viewticket/{{ $ticket->id }}">
                                                                    @switch($ticket->status)
                                                                        @case('open')
                                                                            {{ $ticket->subject }}
                                                                        @break

                                                                        @default
                                                                            <strong>{{ $ticket->subject }}</strong>
                                                                    @endswitch
                                                                </a>
                                                            </td>
                                                            <td>
                                                                @switch($ticket->status)
                                                                    @case('open')
                                                                        {{ __('tickets.pending') }}
                                                                    @break

                                                                    @case('answered')
                                                                        {{ __('tickets.answered') }}
                                                                    @break

                                                                    @case('closed')
                                                                        {{ __('tickets.closed') }}
                                                                    @break

                                                                    @default
                                                                        {{ ucfirst($ticket->status) }}
                                                                @endswitch
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="nowrap">{{ $ticket->last_reply_at ? $ticket->last_reply_at->format('Y-m-d') : $ticket->created_at->format('Y-m-d') }}</span>
                                                                <span
                                                                    class="nowrap">{{ $ticket->last_reply_at ? $ticket->last_reply_at->format('H:i:s') : $ticket->created_at->format('H:i:s') }}</span>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center">{{ __('tickets.no_tickets_found') }}</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <nav class="component_pagination">
                                        <div class="">
                                            @if ($tickets->hasPages())
                                                {{ $tickets->withQueryString()->links() }}
                                            @endif
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            const ticketSubjects = @json($ticketSubjects);
            const categoriesData = @json($categoriesData);

            // ===== CACHE =====
            const categoryMap = {},
                subjectMap = {};
            ticketSubjects.forEach(s => {
                (categoryMap[s.category] ??= []).push(s);
                subjectMap[s.id] = s;
            });

            $(function() {
                const $cat = $('#ticket-category-field');
                const $sub = $('#ticket-subcategory');
                const $subGroup = $('#subcategory-group');
                const $fields = $('#ticket-subcategory-fields');
                const $form = $('#ticketsend');
                const $alert = $('.ticket-danger');

                /* ========= UI HELPERS ========= */
                const showError = msg => {
                    $alert.removeClass('alert-success')
                        .addClass('alert-danger')
                        .show()
                        .find('div').html(msg);
                    $('html,body').animate({
                        scrollTop: $alert.offset().top - 100
                    }, 300);
                };

                const hideError = () => $alert.hide().find('div').html('');

                const resetSub = () => {
                    $subGroup.hide();
                    $sub.empty();
                    $fields.empty();
                };

                const renderFields = subject => {
                    $fields.empty();
                    if (subject?.category === 'Orders' && subject.subcategory) {
                        $fields.append(`
                <div class="form-group">
                    <label>
                        Order ID <span class="text-danger">*</span>
                    </label>
                    <input class="form-control"
                           name="custom_fields[order_id]"
                           placeholder="10867110,10867210"
                           required>
                </div>
            `);
                    }
                };

                /* ========= CATEGORY HANDLER ========= */
                function onCategoryChange() {
                    const list = categoryMap[$cat.val()] || [];

                    if (!list.length) {
                        resetSub();
                        return;
                    }

                    // Build subcategory
                    $sub.html(list.map(s =>
                        `<option value="${s.id}">${s.subcategory || s.category}</option>`
                    ));

                    // SET → SHOW → RENDER (QUAN TRỌNG)
                    const first = list[0];
                    $sub.val(first.id);
                    $subGroup.show();

                    first.show_message_only ? resetSub() : renderFields(first);
                }

                /* ========= INIT ========= */
                categoriesData.forEach(c =>
                    $cat.append(`<option value="${c}">${c}</option>`)
                );

                if ($cat.children().length) {
                    $cat.prop('selectedIndex', 0);
                    onCategoryChange();
                }

                /* ========= EVENTS ========= */
                $cat.on('change', onCategoryChange);
                $sub.on('change', () => renderFields(subjectMap[$sub.val()]));
                $alert.find('.close').on('click', hideError);

                /* ========= FORM SUBMIT ========= */
                $form.on('submit', function(e) {
                    e.preventDefault();
                    hideError();

                    const categoryVal = $cat.val();
                    const subcategoryVal = $sub.val();

                    if (!categoryVal) return showError('Vui lòng chọn danh mục');

                    const categoryList = categoryMap[categoryVal] || [];
                    const subject = subcategoryVal ? subjectMap[subcategoryVal] : categoryList[0];
                    if (!subject) return showError('Danh mục không hợp lệ');

                    const message = $form.find('[name="message"]').val().trim();
                    const orderId = $form.find('[name="custom_fields[order_id]"]').val()?.trim();
                    if (!message) return showError('Vui lòng nhập nội dung');

                    if (subject.category === 'Orders' && subject.subcategory && !orderId)
                        return showError('Vui lòng nhập Order ID');

                    const data = new FormData(this);
                    data.set('category', categoryVal);
                    data.set('subcategory', subject.subcategory || '');

                    $.ajax({
                        url: this.action,
                        method: 'POST',
                        data,
                        processData: false,
                        contentType: false,
                        success: res => {
                            if (!res.success) return showError(res.message || 'Có lỗi xảy ra');

                            $alert.removeClass('alert-danger')
                                .addClass('alert-success')
                                .show()
                                .find('div').html(res.message);

                            this.reset();
                            $cat.prop('selectedIndex', 0);
                            onCategoryChange();
                            $('html,body').animate({
                                scrollTop: 0
                            }, 300);
                        },
                        error: xhr => {
                            let msg = 'Có lỗi xảy ra';
                            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                                msg = Object.values(xhr.responseJSON.errors)
                                    .flat().map(e => `• ${e}`).join('<br>');
                            }
                            showError(msg);
                        }
                    });
                });
            });
        </script>
    @endpush
