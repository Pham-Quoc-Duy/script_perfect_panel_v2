'use strict';

var URL_REQUEST = '/request';

var app = {
    ajax: function(action, data = {}, showLoading = true) {
        if (showLoading) {
            $.blockUI({
                css: {
                    backgroundColor: '#transparent',
                    border: 'none',
                    color: '#fff'
                },
                message: '<div class="spinner-border text-primary" role="status"></div>'
            });
        }

        return new Promise((resolve, reject) => {
            $.post(URL_REQUEST, {
                action: action,
                data: data
            }, response => {
                if (showLoading) {
                    $.unblockUI();
                }
                resolve(response);
            }).fail(function(xhr) {
                if (showLoading) {
                    $.unblockUI();
                }
                try {
                    var error = $.parseJSON(xhr.responseText);
                    reject({
                        error: error
                    });
                } catch (e) {
                    console.log(e);
                    reject({
                        error: 'Ajax error'
                    });
                }
            });
        });
    },

    toastr: function(message, type = 'success') {
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: 'toastr-bottom-center',
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };
        toastr[type](message);
    },

    alert: function(message, type = 'success') {
        return new Promise(function(resolve, reject) {
            var alertType = type == 'error' ? 'danger' : type;
            var modalElement = document.createElement('div');

            modalElement.classList.add('modal', 'fade');
            modalElement.id = 'modal-alert';
            modalElement.tabIndex = '-1';
            modalElement.setAttribute('aria-hidden', 'true');
            modalElement.setAttribute('data-bs-backdrop', 'static');
            modalElement.innerHTML = '\n' +
                '                <div class="modal-dialog modal-dialog-centered rounded-4">\n' +
                '                    <div class="modal-content">\n' +
                '                        <div class="modal-header bg-' + alertType + ' text-white py-4">\n' +
                '                            <h4 class="modal-title text-white ls-1">' + app.language('core', 'Alert') + '</h4>\n' +
                '                        </div>\n' +
                '                        <div class="modal-body py-10 fs-4" style="word-break: break-word;">\n' +
                '                            ' + message + '\n' +
                '                        </div>\n' +
                '                        <div class="modal-footer text-center py-4">\n' +
                '                            <button type="button" class="btn btn-sm btn-' + alertType + ' px-4 rounded-4" data-bs-dismiss="modal">' + app.language('core', 'Read') + '</button>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            ';

            document.body.appendChild(modalElement);
            new bootstrap.Modal(modalElement).show();

            modalElement.addEventListener('hidden.bs.modal', function() {
                document.body.removeChild(modalElement);
                resolve(true);
            });
        });
    },

    confirm: function(message) {
        return new Promise(function(resolve, reject) {
            var modalElement = document.createElement('div');

            modalElement.classList.add('modal', 'fade');
            modalElement.id = 'modal-confirm';
            modalElement.tabIndex = '-1';
            modalElement.setAttribute('aria-hidden', 'true');
            modalElement.setAttribute('data-bs-backdrop', 'static');
            modalElement.innerHTML = '\n' +
                '                <div class="modal-dialog modal-dialog-centered rounded-4">\n' +
                '                    <div class="modal-content">\n' +
                '                        <div class="modal-header bg-warning text-white py-4">\n' +
                '                            <h4 class="modal-title text-white ls-1">' + app.language('core', 'Confirm') + '</h4>\n' +
                '                        </div>\n' +
                '                        <div class="modal-body py-10 fs-4">\n' +
                '                            ' + message + '\n' +
                '                        </div>\n' +
                '                        <div class="modal-footer py-4">\n' +
                '                            <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4" id="btn-modal-confirm-cancel" data-bs-dismiss="modal">' + app.language('core', 'Cancel') + '</button>\n' +
                '                            <button type="button" class="btn btn-sm btn-warning px-4 rounded-4" id="btn-modal-confirm-ok">' + app.language('core', 'Agree') + '</button>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            ';

            document.body.appendChild(modalElement);
            var modal = new bootstrap.Modal(modalElement);
            modal.show();

            document.getElementById('btn-modal-confirm-ok').onclick = function() {
                modalElement.addEventListener('hidden.bs.modal', function() {
                    resolve(true);
                    document.body.removeChild(modalElement);
                });
                modal.hide();
            };

            document.getElementById('btn-modal-confirm-cancel').onclick = function() {
                modalElement.addEventListener('hidden.bs.modal', function() {
                    reject();
                    document.body.removeChild(modalElement);
                });
                modal.hide();
            };
        });
    },

    prompt: function(message, defaultValue = '', title = 'Input value') {
        return new Promise(function(resolve, reject) {
            var modalElement = document.createElement('div');

            modalElement.classList.add('modal', 'fade');
            modalElement.id = 'modal-prompt';
            modalElement.tabIndex = '-1';
            modalElement.setAttribute('aria-hidden', 'true');
            modalElement.innerHTML = '\n' +
                '                <div class="modal-dialog modal-dialog-centered rounded-4">\n' +
                '                    <div class="modal-content">\n' +
                '                        <div class="modal-header bg-primary text-white py-4">\n' +
                '                            <h4 class="modal-title text-white ls-1">' + title + '</h4>\n' +
                '                        </div>\n' +
                '                        <div class="modal-body py-10">\n' +
                '                            <p>' + message + '</p>\n' +
                '                            <input type="text" class="form-control form-control-solid" id="ipt-prompt-value" value="' + defaultValue + '">\n' +
                '                        </div>\n' +
                '                        <div class="modal-footer">\n' +
                '                            <button type="button" class="btn btn-sm btn-secondary px-4 rounded-4" id="btn-modal-prompt-cancel" data-bs-dismiss="modal">' + app.language('core', 'Cancel') + '</button>\n' +
                '                            <button type="button" class="btn btn-sm btn-primary px-4 rounded-4" id="btn-modal-prompt-ok">' + app.language('core', 'Submit') + '</button>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            ';

            document.body.appendChild(modalElement);
            var modal = new bootstrap.Modal(modalElement);
            modal.show();

            modalElement.addEventListener('shown.bs.modal', function() {
                document.getElementById('ipt-prompt-value').focus();
            });

            document.getElementById('btn-modal-prompt-ok').onclick = function() {
                modalElement.addEventListener('hidden.bs.modal', function() {
                    const value = document.getElementById('ipt-prompt-value').value.trim();
                    resolve(value);
                    document.body.removeChild(modalElement);
                });
                modal.hide();
            };

            document.getElementById('btn-modal-prompt-cancel').onclick = function() {
                modalElement.addEventListener('hidden.bs.modal', function() {
                    reject();
                    document.body.removeChild(modalElement);
                });
                modal.hide();
            };
        });
    },

    gtag: function(eventName = 'Unknown', eventLog = '') {
        if (typeof gtag === 'function') {
            gtag('event', eventName, {
                event_log: eventLog
            });
        }
    },

    language: function(category, key) {
        if (LANGUAGE.language) {
            if (LANGUAGE.language[category]) {
                if (LANGUAGE.language[category][key]) {
                    return LANGUAGE.language[category][key];
                } else {
                    return LANGUAGE.core[category][key];
                }
            } else {
                return LANGUAGE.core[category][key];
            }
        } else {
            return LANGUAGE.core[category][key];
        }
    },

    randomText: function(keyword, count = 3) {
        var loremText = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industrys standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book It has survived not only five centuries but also the leap into electronic typesetting remaining essentially unchanged It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form by injected humour or randomised words which dont look even slightly believable If you are going to use a passage of Lorem Ipsum you need to be sure there isnt anything embarrassing hidden in the middle of text All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary making this the first true generator on the Internet It uses a dictionary of over 200 Latin words combined with a handful of model sentence structures to generate Lorem Ipsum which looks reasonable The generated Lorem Ipsum is therefore always free from repetition injected humour or non character words etc estimate paint upset allocate create distribute want supplement match disturb thrust earn clutch compose occur manipulate wave enhance plunge listen stretch permit opt whisper imagine play promote render condemn light peer enforce murder combine wait impress resemble land protect need walk approve characterise record remark dismiss ride show criticize like own compile dress process transport dissolve brainstorm accuse drain bloom complete campaign reverse matter dominate forget induce stress inform ban prevent collect explain have tuck destroy encourage put hurry stick whisper attract stretch reply enforce enquire quote rub appoint spin concentrate time express review fund disturb inspect tie conceal suppress mount touch find learn close wish apply going pop incur leave shrug elect deem vary name slip swear prove give laugh move bring break rule boast smile shift bind react cite cook shout stare march aim lend dip cast ring order help sound value bend form train hunt own wrap'.toLowerCase();
        var words = loremText.split(' ');
        var result = [];
        var randomIndex = Math.floor(Math.random() * count);

        for (var i = 0; i < count; i++) {
            result.push(words[Math.floor(Math.random() * words.length)]);
        }

        result[randomIndex] = keyword;
        return result.join(' ');
    },

    wait: function(seconds) {
        return new Promise((resolve, reject) => {
            setTimeout(function() {
                resolve();
            }, seconds * 1000);
        });
    },

    escapeHtml: function(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(char) {
            return map[char];
        });
    },

    queryURL: function() {
        var params = new URLSearchParams(window.location.search);
        return Object.fromEntries(params.entries());
    },

    preciseNumber: function(number, precision = 3) {
        const multiplier = Math.pow(10, precision);
        return Math.round(number * multiplier) / multiplier;
    },

    timeAvg: function(seconds) {
        let hours = Math.floor(seconds / 3600);
        hours = hours === 0 ? '' : hours + 'h';

        let minutes = Math.floor(seconds / 60 % 60);
        minutes = minutes === 0 ? '' : minutes + 'm';

        seconds = seconds % 60;
        seconds = seconds === 0 ? '' : seconds + 's';

        return hours + ' ' + minutes + ' ' + seconds;
    },

    convertMoney: function(amount) {
        var converted = typeof CURRENCY_ID == 'undefined' || CURRENCY_ID == 1 ?
            amount :
            '' + parseFloat(amount * CURRENCY_RATE).toFixed(3) * 1;

        converted = typeof CURRENCY_ID != 'undefined' && CURRENCY_ID == 154 ?
            Math.ceil(converted).toLocaleString() :
            converted;

        return converted;
    },

    convertCurrency: function(amount, currencyId, rate, symbol = '', position = 'top') {
        let converted = amount * 1;
        converted = currencyId === 1 ? converted : app.preciseNumber(converted * rate, 10);
        converted = currencyId === 154 ? Math.ceil(converted).toLocaleString() : converted;

        if (currencyId === 1) {
            converted = (symbol ? '$ ' : '') + converted;
        } else {
            converted += symbol ? (position === 'top' ? ' <sup>' + symbol + '</sup>' : ' ' + symbol) : '';
        }

        return converted;
    },

    clipboard: function(selector) {
        const element = document.querySelector(selector);
        const nextElement = element.nextElementSibling;

        var clipboard = new ClipboardJS(nextElement, {
            target: element,
            text: function() {
                return element.innerHTML;
            }
        });

        clipboard.on('success', function(e) {
            const originalText = nextElement.innerHTML;
            if (nextElement.innerHTML === 'Copied!') {
                return;
            }

            nextElement.innerHTML = 'Copied!';
            setTimeout(() => nextElement.innerHTML = originalText, 5000);
        });
    },

    download: function(filename, content) {
        var link = document.createElement('a');
        link.setAttribute('href', 'data:text/plain;charset=utf-8, ' + encodeURIComponent(content));
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    },

    showBlock: function() {
        app.alert('<p class="mb-1">1DG has changed its domain to <a target="_blank" href="https://smmko.com" class="fw-bold">smmko.com</a></p>\n<p class="mb-1">Your data remains unchanged.</p>\n<p class="mb-1">Please log in to your account at <a target="_blank" href="https://smmko.com" class="fw-bold">smmko.com</a></p><hr />\n<p class="mb-1">1dg thay đổi domain mới thành <a target="_blank" href="https://smmko.com" class="fw-bold">smmko.com</a></p>\n<p class="mb-1">Dữ liệu của bạn được giữ nguyên</p>\n<p class="mb-1">Vui lòng đăng nhập tk của bạn tại <a target="_blank" href="https://smmko.com" class="fw-bold">smmko.com</a></p>', 'error');
    },

    on: {
        click: {
            changeLanguage: async function(language) {
                app.gtag('Account-changeLanguage', language);
                try {
                    var response = await app.ajax('change_language', {
                        language: language
                    }, 'body');

                    if (response.error) {
                        throw response;
                    }

                    window.location.reload();
                } catch (error) {
                    app.alert(error.error, 'danger');
                }
            }
        },
        change: {
            currency: async function(currencyId) {
                app.gtag('Account-changeCurrency', currencyId);
                try {
                    var response = await app.ajax('change_currency', {
                        currency: currencyId
                    }, 'body');

                    if (response.error) {
                        throw response;
                    }

                    window.location.reload();
                } catch (error) {
                    app.alert(error.message, 'danger');
                }
            }
        }
    }
};