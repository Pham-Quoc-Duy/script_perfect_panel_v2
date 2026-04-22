 <div class="toolbar py-3 py-lg-6" id="kt_toolbar">
     <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap gap-2">
         <div class="page-title d-flex flex-column align-items-start me-3 py-2 py-lg-0 gap-2">
             <?php if($pageTitle): ?>
                 <h1 class="d-flex text-gray-900 fw-bold m-0 fs-3" id="page-title" data-lang="<?php echo e($pageTitle); ?>">
                     <?php echo e($pageTitle); ?></h1>
                 <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                     <li class="breadcrumb-item text-gray-600" id="breadcrumb-item" data-lang="<?php echo e($pageTitle); ?>">
                         <?php echo e($pageTitle); ?></li>
                 </ul>
             <?php endif; ?>
         </div>
         <div class="d-flex align-items-center gap-2">
             <button type="button" id="toggleNotes"
                 class="btn btn-icon btn-color-warning bg-body w-35px h-35px w-lg-40px h-lg-40px btn-open-note"
                 data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ghi chú">
                 <i class="ki-duotone ki-document fs-2 fs-md-1">
                     <span class="path1"></span>
                     <span class="path2"></span>
                 </i>
             </button>
             <a href="javascript:;" class="btn bg-body px-5 text-muted fw-semibold" id="current-date-display">
                 <span id="current-date-text"><?php echo e(now()->format('Y/m/d')); ?> (<?php echo e(now()->format('P')); ?>)</span>
             </a>
         </div>
     </div>
 </div>

 <!--Sticky note — cấu trúc từ t.html-->
 <div class="sticky-note hidden" id="stickyNotes">
     <div class="note-header">
         <h3 class="text-gray-600 m-0">
             <span data-page="message" data-lang="Sticky Note">Ghi chú</span>
             <span class="fs-9 fst-italic note-save-status"></span>
         </h3>
         <span class="btn-hide-note text-gray-600 close-btn" id="closeBtn">✖</span>
     </div>
     <div class="note-body ms-5 me-5">
         <textarea class="form-control form-control-flush p-0" id="txa-sticky-note"
             data-kt-autosize="true" placeholder="Note"
             style="overflow:hidden;overflow-wrap:break-word;resize:none;text-align:start;height:44px;"></textarea>
     </div>
 </div>

 <style>
     .sticky-note {
         background: #fef9c3;
         border-radius: 10px;
         box-shadow: 0 4px 20px rgba(0,0,0,.15);
         width: 228px;
         position: fixed;
         z-index: 1060;
         padding-bottom: 16px;
         transform-origin: top right;
     }
     .sticky-note.hidden { display: none !important; }
     .sticky-note.opening { animation: noteOpen .2s ease forwards; }
     .sticky-note.closing { animation: noteClose .18s ease forwards; }

     @keyframes noteOpen {
         from { opacity: 0; transform: scale(.88) translateY(-8px); }
         to   { opacity: 1; transform: scale(1) translateY(0); }
     }
     @keyframes noteClose {
         from { opacity: 1; transform: scale(1) translateY(0); }
         to   { opacity: 0; transform: scale(.88) translateY(-8px); }
     }

     .note-header { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px 8px; }
     .note-header h3 { font-size: 1rem; font-weight: 700; }
     .note-save-status { margin-left: 6px; color: #888; }
     .close-btn { cursor: pointer; font-size: .9rem; opacity: .6; line-height: 1; transition: opacity .15s; }
     .close-btn:hover { opacity: 1; }
     .note-body textarea { background: transparent !important; border: none !important; box-shadow: none !important; width: 100%; font-size: .9rem; }
 </style>

 <script>
 (function () {
     function openNote(btn, panel, txa) {
         // Vị trí ngay dưới button
         var rect = btn.getBoundingClientRect();
         panel.style.top  = (rect.bottom + 8) + 'px';
         panel.style.right = (window.innerWidth - rect.right) + 'px';

         panel.classList.remove('hidden', 'closing');
         panel.classList.add('opening');
         panel.addEventListener('animationend', function h() {
             panel.classList.remove('opening');
             panel.removeEventListener('animationend', h);
         });
         if (txa) { txa.focus(); txa.style.height = 'auto'; txa.style.height = Math.max(44, txa.scrollHeight) + 'px'; }
     }

     function closeNote(panel) {
         panel.classList.remove('opening');
         panel.classList.add('closing');
         panel.addEventListener('animationend', function h() {
             panel.classList.remove('closing');
             panel.classList.add('hidden');
             panel.removeEventListener('animationend', h);
         });
     }

     function init() {
         var btn    = document.getElementById('toggleNotes');
         var panel  = document.getElementById('stickyNotes');
         var close  = document.getElementById('closeBtn');
         var txa    = document.getElementById('txa-sticky-note');
         var status = panel && panel.querySelector('.note-save-status');
         var KEY    = 'sticky_note_v1';

         if (!btn || !panel) return;

         if (typeof bootstrap !== 'undefined') new bootstrap.Tooltip(btn);
         if (txa) txa.value = localStorage.getItem(KEY) || '';

         btn.addEventListener('click', function () {
             panel.classList.contains('hidden') ? openNote(btn, panel, txa) : closeNote(panel);
         });

         if (close) close.addEventListener('click', function () { closeNote(panel); });

         if (txa) {
             txa.addEventListener('input', function () {
                 txa.style.height = 'auto';
                 txa.style.height = Math.max(44, txa.scrollHeight) + 'px';
                 clearTimeout(txa._t);
                 txa._t = setTimeout(function () {
                     localStorage.setItem(KEY, txa.value);
                     if (status) { status.textContent = 'Saved'; setTimeout(function () { status.textContent = ''; }, 2000); }
                 }, 600);
             });
         }
     }

     document.readyState === 'loading' ? document.addEventListener('DOMContentLoaded', init) : init();
 })();
 </script>
<?php /**PATH C:\xampp\htdocs\resources\views/adminpanel/layouts/toolbar.blade.php ENDPATH**/ ?>