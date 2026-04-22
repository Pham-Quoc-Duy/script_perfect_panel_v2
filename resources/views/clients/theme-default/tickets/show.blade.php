@extends('clients.theme-default.layouts.app')

@section('title', 'Ticket #' . $ticket->id)

@section('content')

    <!-- Main variables *content* -->
    <div id="block_53">
        <div class="block-bg"></div>
        <div class="container">
            <div class="ticket-dialog ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="component_card">
                            <div class="card">
                                <div>
                                    <div class="ticket-dialog__title">
                                        <h3>{{ $ticket->subject }}</h3>
                                    </div>
                                    <div class="ticket-dialog__body component_ticket_messages">
                                        <div class="">
                                            {{-- Message gốc từ table tickets - hiển thị 1 lần đầu tiên --}}
                                            <div class="ticket-dialog__row ticket-dialog__row-admin">
                                                <div class="ticket-dialog__row-message">
                                                    <span>
                                                        @if($ticket->ticketSubject)
                                                            <div><b>{{ $ticket->ticketSubject->category }}{{ $ticket->ticketSubject->subcategory ? ' - ' . $ticket->ticketSubject->subcategory : '' }}</b></div>
                                                        @endif
                                                        @if($ticket->custom_fields)
                                                            @php
                                                                $requiredFields = $ticket->ticketSubject?->required_fields ?? [];
                                                                $fieldMap = collect($requiredFields)->keyBy('id');
                                                            @endphp
                                                            @foreach($ticket->custom_fields as $fieldId => $value)
                                                                @if($value)
                                                                    @php
                                                                        $field = $fieldMap->get($fieldId);
                                                                        $label = $field ? $field['name'] . ($field['placeholder'] ? ' (example: ' . $field['placeholder'] . ')' : '') : ucfirst($fieldId);
                                                                    @endphp
                                                                    <div><b>{{ $label }}</b>: {{ $value }}</div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if($ticket->ticketSubject || $ticket->custom_fields)
                                                            <hr>
                                                        @endif
                                                        {!! nl2br(e($ticket->message)) !!}
                                                    </span>
                                                </div>
                                                <div class="ticket-dialog__row-bottom">
                                                    <div class="ticket-dialog__row-bottom-name">{{ $ticket->user->username ?? $ticket->user->name ?? 'N/A' }}</div>
                                                    <div class="ticket-dialog__row-bottom-date">{{ $ticket->created_at->format('Y-m-d H:i:s') }}</div>
                                                </div>
                                            </div>

                                            {{-- Replies từ table ticket_reply --}}
                                            @foreach ($ticket->replies as $reply)
                                                <div class="ticket-dialog__row {{ $reply->is_admin ? 'ticket-dialog__row-user' : 'ticket-dialog__row-admin' }}">
                                                    <div class="ticket-dialog__row-message">
                                                        <span>
                                                            {!! nl2br(e($reply->message)) !!}
                                                            @if ($reply->hasAttachments())
                                                                <div class="attachments" style="margin-top: 10px;">
                                                                    @foreach ($reply->getAttachmentsList() as $attachment)
                                                                        <div class="attachment-item">
                                                                            <a href="{{ asset('storage/' . $attachment['file_path']) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                                📎 {{ $attachment['original_name'] }}
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="ticket-dialog__row-bottom">
                                                        <div class="ticket-dialog__row-bottom-name">
                                                            {{ $reply->is_admin ? 'support' : ($reply->user->username ?? $reply->user->name ?? 'N/A') }}
                                                        </div>
                                                        <div class="ticket-dialog__row-bottom-date">{{ $reply->created_at->format('Y-m-d H:i:s') }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if ($ticket->status !== 'closed')
                                        <div class="ticket-dialog__footer component_form_group">
                                            <form method="post" action="{{ route('clients.tickets.reply', $ticket->id) }}"
                                                id="reply-form">
                                                @csrf
                                                <div class="">
                                                    <div class="form-group">
                                                        <label>Message</label>
                                                        <textarea class="form-control" rows="7" name="TicketMessageForm[message]" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="tickets-uploader" data-rtl="false"
                                                            data-lang-button-attach="Attach files"
                                                            data-lang-file-format-incorrect="Invalid file format"
                                                            data-lang-file-size-incorrect="File is too large (limit 5 MB)">
                                                            <input type="file" id="reply-files-input" multiple=""
                                                                accept="image/jpg,image/jpeg,image/png,image/gif,text/plain,text/csv,application/pdf"
                                                                style="display: none;">
                                                            <div class="files-wrapper">
                                                                <button type="button" id="reply-uploader-button"
                                                                    style="background: none;display: flex;align-items: center;align-self: flex-start;padding: 0;border: none;">
                                                                    <a href="#" onclick="event.preventDefault()"
                                                                        class="paperclip"
                                                                        style="display: flex;align-items: center;justify-content: center;">
                                                                        <svg width="24px" height="24px"
                                                                            fill="currentColor" viewBox="0 0 24 24"
                                                                            version="1.1"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                            <title>paperclip</title>
                                                                            <g id="paperclip" stroke="none"
                                                                                stroke-width="1" fill-rule="evenodd">
                                                                                <path
                                                                                    d="M15.4604059,6.38639442 C14.683645,5.60296995 13.4230004,5.60296995 12.6462396,6.38639442 L6.78869877,12.2941855 C5.44846797,13.6459138 5.44846797,15.8356494 6.78869877,17.1873777 C8.12892957,18.539106 10.3000398,18.539106 11.6402706,17.1873777 L16.4791086,12.3070285 C16.8261043,11.9570561 17.3927577,11.9570561 17.7397533,12.3070285 C18.0867489,12.657001 18.0867489,13.2285155 17.7397533,13.5784879 L12.9009152,18.4588371 C10.8635097,20.513721 7.56545961,20.513721 5.52805412,18.4588371 C3.49064863,16.4039532 3.49064863,13.07761 5.52805412,11.0227261 L11.3855949,5.11493503 C12.8595304,3.62835499 15.247115,3.62835499 16.7210505,5.11493503 C18.1949861,6.60151508 18.1949861,9.0095821 16.7210505,10.4961621 L11.1181854,16.1470928 C10.2077199,17.065369 8.73060088,17.065369 7.8201353,16.1470928 C6.90966972,15.2288165 6.90966972,13.7390257 7.8201353,12.8207495 L12.4042977,8.19726082 C12.7512933,7.84728842 13.3179467,7.84728842 13.6649423,8.19726082 C14.0119379,8.54723323 14.0119379,9.11874781 13.6649423,9.46872021 L9.08077994,14.0922089 C8.86748906,14.3073296 8.86748906,14.6605127 9.08077994,14.8756334 C9.29407083,15.090754 9.6442499,15.090754 9.85754079,14.8756334 L15.4604059,9.22470275 C16.2371667,8.44127828 16.2371667,7.16981889 15.4604059,6.38639442 Z"
                                                                                    id="Path" fill-rule="nonzero">
                                                                                </path>
                                                                            </g>
                                                                        </svg>
                                                                    </a>
                                                                    <span style="margin: 0px 8px" class="files-label">Attach
                                                                        files</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="component_button_submit">
                                                    <div class="">
                                                        <button class="btn btn-block btn-big-primary" type="submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            This ticket has been closed.
                                        </div>
                                    @endif
                                </div>
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
        $(document).ready(function() {
            // Handle file upload for reply
            $('#reply-uploader-button').on('click', function() {
                $('#reply-files-input').click();
            });

            $('#reply-files-input').on('change', function() {
                const files = this.files;
                const filesList = $('.files-wrapper');

                // Clear previous file list
                filesList.find('.file-item').remove();

                // Add new files to display
                Array.from(files).forEach(function(file, index) {
                    const fileItem = `
                <div class="file-item" style="margin-top: 5px;">
                    <small>${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</small>
                    <button type="button" class="btn btn-sm btn-danger remove-file" data-index="${index}" style="margin-left: 10px;">×</button>
                </div>
            `;
                    filesList.append(fileItem);
                });
            });

            // Handle file removal
            $(document).on('click', '.remove-file', function() {
                const index = $(this).data('index');
                const fileInput = $('#reply-files-input')[0];
                const dt = new DataTransfer();

                // Rebuild file list without removed file
                Array.from(fileInput.files).forEach((file, i) => {
                    if (i !== index) {
                        dt.items.add(file);
                    }
                });

                fileInput.files = dt.files;
                $(this).parent().remove();
            });

            // Handle reply form submission
            $('#reply-form').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // Add files to form data
                const files = $('#reply-files-input')[0].files;
                Array.from(files).forEach(function(file) {
                    formData.append('attachments[]', file);
                });

                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.text();

                // Disable submit button
                submitBtn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Reload page to show new reply
                            location.reload();
                        } else {
                            alert(response.message || 'An error occurred');
                        }
                    },
                    error: function(xhr) {
                        let message = 'An error occurred';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = Object.values(xhr.responseJSON.errors).flat();
                            message = errors.join('\n');
                        }
                        alert(message);
                    },
                    complete: function() {
                        // Re-enable submit button
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            });
        });
    </script>
@endpush
