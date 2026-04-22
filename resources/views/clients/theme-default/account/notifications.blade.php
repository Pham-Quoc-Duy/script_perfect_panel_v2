@extends('clients.theme-default.layouts.app')

@section('title', __('account.notifications_settings'))

@section('content')
    <div class="wrapper-content">
        <div class="wrapper-content__header">
        </div>
        <div class="wrapper-content__body">
            <!-- Main variables *content* -->
            <div id="block_88">
                <div class="block-bg"></div>
                <div class="container">
                    <div class="notifications ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="notifications-tabs margin-card">
                                    <div class="component_tabs ">
                                        <ul class="nav nav-pills tab">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('clients.account.index') }}">{{ __('account.general') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="{{ route('clients.notifications.index') }}">{{ __('account.notifications_settings') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="component_card">
                                    <div class="card margin-card">
                                        <h5>{{ __('account.telegram_notifications') }}</h5>
                                        <form action="{{ route('clients.notifications.connect-telegram') }}" method="post">
                                            @csrf
                                            <div class="component_button_primary">
                                                <button type="submit" class="btn btn-big-primary btn-block">{{ __('account.connect') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="margin-card">
                                    <form action="{{ route('clients.notifications.update') }}" method="post">
                                        @csrf
                                        <div class="table-bg component_table ">
                                            <div class="table-wr table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('account.notification') }}</th>
                                                            <th>{{ __('account.email_label') }}</th>
                                                            <th>{{ __('account.telegram') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ __('account.api_key_changed') }}</td>
                                                            <td>
                                                                <span class="component_checkbox">
                                                                    <input type="hidden" name="notifications[email][api_key_changed]" value="0">
                                                                    <div class="form-group__checkbox">
                                                                        <label class="form-group__checkbox-label">
                                                                            <input type="checkbox" name="notifications[email][api_key_changed]" value="1" checked>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="component_checkbox">
                                                                    <input type="hidden" name="notifications[telegram][api_key_changed]" value="0">
                                                                    <div class="form-group__checkbox">
                                                                        <label class="form-group__checkbox-label" data-toggle="tooltip" data-placement="top" title="Connect to the telegram bot to receive notifications.">
                                                                            <input type="checkbox" name="notifications[telegram][api_key_changed]" value="1" checked disabled>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('account.new_message') }}</td>
                                                            <td>
                                                                <span class="component_checkbox">
                                                                    <input type="hidden" name="notifications[email][new_message]" value="0">
                                                                    <div class="form-group__checkbox">
                                                                        <label class="form-group__checkbox-label">
                                                                            <input type="checkbox" name="notifications[email][new_message]" value="1" checked>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="component_checkbox">
                                                                    <input type="hidden" name="notifications[telegram][new_message]" value="0">
                                                                    <div class="form-group__checkbox">
                                                                        <label class="form-group__checkbox-label" data-toggle="tooltip" data-placement="top" title="Connect to the telegram bot to receive notifications.">
                                                                            <input type="checkbox" name="notifications[telegram][new_message]" value="1" checked disabled>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <div class="component_button_primary">
                                                                    <button type="submit" class="btn btn-big-primary btn-block">{{ __('account.save_changes_button') }}</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
        <div class="wrapper-content__footer">
        </div>
    </div>
@endsection
