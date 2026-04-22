</div>

    </main>


    <script type="text/javascript" src="https://storage.perfectcdn.com/libs/jquery/1.12.4/jquery.min.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/fgks9m94k0nhqmix.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/8gmoznjnttfyk1mz.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/w8l498eitwhkze7w.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/jq8derbjf313z5ai.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/global/0ud5szi4ocdmm9ep.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/hmz1fi/5rlpuzscp8ism29e.js">
    </script>
    <script type="text/javascript" src="https://storage.perfectcdn.com/hmz1fi/farxtjet462wr6bi.js">
    </script>

    <script type="text/javascript">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>


    <script>
        $('#want').change(function () {
            if ($(this).val() == 'Cancel') {
                $('.reason-box').css('display', 'block');
                $('#reason').prop('required', true);
            } else {
                $('.reason-box').css('display', 'none');
                $('#reason').prop('required', false);
            }
        });
        $('#point-options').change(function () {
            if ($(this).val() == 'Redeem Points') {
                $('#howmanyPoints').css('display', 'block');
            } else {
                $('#howmanyPoints').css('display', 'none');
            }
        });
    </script>

    <script type="text/javascript">

        $(document).ready(function () {
            $(".search-wrap").keyup(function () {
                var searchTerm = $("#searchService").val();
                var listItem = $('#service-table tbody').children('tr');
                var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
                $.extend($.expr[':'], {
                    'containsi': function (elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

                $("#service-table tbody tr:containsi('" + searchSplit + "')").each(function (e) {
                    $(this).attr('visible', 'true');
                });
                $("#service-table thead tr:containsi('" + searchSplit + "')").each(function (e) {
                    $(this).attr('visible', 'true');
                });



                $("#service-table tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
                    $(this).attr('visible', 'false');
                });
                $("#service-table thead tr").not(":containsi('" + searchSplit + "')").each(function (e) {
                    $(this).attr('visible', 'false');
                });

                $("tr.separator:first-child, tr.separator:last-child").each(function (e) {
                    $(this).attr('visible', 'false');
                });
            });


            $("#searchService").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#service-table tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) != -1)
                });
            });
        });


        /*   function filterService(category) {
        alert(category);
        $('.service-well, .service-well tbody tr').attr('visible','false');
        $('.service-well[data-category="' + category + '"], .service-well tbody tr[data-category="' + category + '"]').attr('visible','true');
        }*/

        function filterService(category) {
            $('#service-table tbody tr').attr('visible', 'false');
            $('#service-table tbody').attr('visible', 'false');
            $('#service-table thead').attr('visible', 'false');

            $('#service-table tbody tr[data-category="' + category + '"]').attr('visible', 'true');
            $('#service-table tbody[data-category="' + category + '"]').attr('visible', 'true');
            $('#service-table thead[data-category="' + category + '"]').attr('visible', 'true');

            $('#service-table thead tr').attr('visible', 'false');
            $('#service-table tbody').attr('visible', 'false');
            $('#service-table thead').attr('visible', 'false');

            $('#service-table thead tr[data-category="' + category + '"]').attr('visible', 'true');
            $('#service-table thead[data-category="' + category + '"]').attr('visible', 'true');
            $('#service-table tbody[data-category="' + category + '"]').attr('visible', 'true');
        }

        function allser() {
            $("#service-table tbody tr").attr('visible', 'true');
            $("#service-table thead tr").attr('visible', 'true');
            $("#service-table tbody").attr('visible', 'true');
            $("#service-table thead").attr('visible', 'true');
        }

    </script>


    <!--  Some Script Content From Old Themes  -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"
        integrity="sha512-Y+0b10RbVUTf3Mi0EgJue0FoheNzentTMMIE2OreNbqnUPNbQj8zmjK3fs5D2WhQeGWIem2G2UkKjAL/bJ/UXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        function navToggleMob() {
            let menuBox = document.getElementById('navMob');
            menuBox.classList.toggle('active');
        }


        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#navbar").addClass("shrink");
            } else {
                $("#navbar").removeClass("shrink");
            }

            if (scroll >= 300) {
                $("#navbar").addClass("fixed-top");
            } else {
                $("#navbar").removeClass("fixed-top");
            }
        });

    </script>

    <script type="text/javascript">
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        if ($(window).width() < 991) {
            $('#wrapper').removeClass('toggled');
        } else {
            $('#wrapper').addClass('toggled');
        }
    </script>

    <!-- /// Some Script Content From Old Themes  -->

    <script>
        $(function () {
            $("#search").keyup(function () {
                searchServices();
            });
        });
    </script>




    <!-- script for show more btn -->
    <script>
        const showMorebtn = document.getElementById('showMore');
        showMorebtn.addEventListener('click', function (e) {
            const targetThat = document.getElementById('more_menu');
            targetThat.classList.toggle('active_more_menu');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha512-iztkobsvnjKfAtTNdHkGVjAYTrrtlC7mGp/54c40wowO7LhURYl3gVzzcEqGl/qKXQltJ2HwMrdLcNUdo+N/RQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        $('#orderform-service').on('change', function () {
            setTimeout(function () {
                let mainTime = $('#field-orderform-fields-average_time').val();
                document.getElementById('average_time').innerHTML = mainTime;
            }, 100)
        });
    </script>
</body>

</html>