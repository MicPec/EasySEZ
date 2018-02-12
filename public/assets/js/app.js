$(function() {
  new WOW().init();

  if (Cookies.get("EasySez_toolbar_expanded") == 1) {
    $(".app-container").toggleClass("expanded")
  };

  initselect2([]);

  $('#color').colorpicker({
    useAlpha: false,
    format: "hex"
  });

  $('.datepicker').datepicker({
    todayBtn: "linked",
    clearBtn: true,
    language: "pl",
    todayHighlight: true,
    daysOfWeekDisabled: "0",
  });

  $('.input-daterange').datepicker({
    todayBtn: "linked",
    clearBtn: true,
    language: "pl",
    todayHighlight: true,
    daysOfWeekDisabled: "0",
  });

  $('.input-daterange input').each(function() {
    $(this).datepicker("clearDates");
  });

  $('#btn-print').on('click', function(e) {
    e.preventDefault();
    $('#summary').printThis({
      importCSS: true,
      importStyle: true,
      // printContainer: false,
      loadCSS: ["/assets/css/print.css"],
      // pageTitle: "",
      // removeInline: true,
      printDelay: 333,
      // formValues: true
    });
  });

  $('.statusModal').on('click', function(e) {
    var button = $(e.currentTarget); // Button that triggered the modal
    var order = button.data('order'); // Extract info from data-* attributes
    var modal = $('.modal-content').load('/api/getStatusModal/' + order, function() {
      initselect2();
    });
    $('#modal').modal();
    $('.modalform').validator()
  });

  $('.addFlag').on('click', function(e) {
    var button = $(e.currentTarget); // Button that triggered the modal
    var order = button.data('order'); // Extract info from data-* attributes
    var modal = $('.modal-content').load('/api/getAddFlagModal/' + order, function() {
      initselect2();
    });
    $('#modal').modal();
  });

  $('.noteModal').on('click', function(e) {
    var button = $(e.currentTarget); // Button that triggered the modal
    var order = button.data('order'); // Extract info from data-* attributes
    var modal = $('.modal-content').load('/api/getNoteModal/' + order);
    $('#modal').modal();
  });

  $('.statuslogModal').on('click', function(e) {
    var button = $(e.currentTarget); // Button that triggered the modal
    var order = button.data('order'); // Extract info from data-* attributes
    var modal = $('.modal-content').load('/api/getStatuslogModal/' + order);
    $('#modal').modal();
  });

  $('.confirm').on('click', function(e) {
    var button = $(e.currentTarget); // Button that triggered the modal
    var link = button.data('link') + '/' + button.data('val1');
    if (typeof button.data('val2') !== "undefined") {
      link += '/' + button.data('val2');
    }
    var modal = $('.modal-content').load(link);
    // console.log(link);
    $('#modal').modal();
  });

  $('input#qty, select#product').on('change', function(e) {
    var qty = $('input#qty').val();
    // var uprice = $('select#product option:selected').data('uprice');
    var uprice = $('input[name=uprice]').val();
    // $('p#uprice').text('Sugerowana cena: ' + (qty * uprice).toFixed(2));
    $('input[name=price]').attr('placeholder', 'Sugerowana cena: ' + (qty * uprice).toFixed(2));
  });

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 10000);

  $(function() {
    $(".navbar-expand-toggle").click(function() {
      var expanded = $(".app-container").toggleClass("expanded");
      if (expanded.hasClass("expanded") && $(window).width() > 768) {
        Cookies.set("EasySez_toolbar_expanded", 1)
      } else {
        Cookies.set("EasySez_toolbar_expanded", 0)
      };
      return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
    });
    return $(".navbar-right-expand-toggle").click(function() {
      $(".navbar-right").toggleClass("expanded");
      return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
    });
  });

  $(function() {
    return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
      return $(".side-menu .nav .dropdown .collapse").collapse('hide');
    });
  });

  if (($(window).height() + 100) < $(document).height()) {
    $('#top-link-block').removeClass('hidden').affix({
      // how far to scroll down before link "slides" into view
      offset: {
        top: 100
      }
    });
  };


  function initselect2(options) {
    $('.ajaxselect').select2({
      width: "100%",
      theme: "bootstrap",
      language: "pl",
      minimumResultsForSearch: 10,
      dropdownParent: $('#modal'),
      ajax: {
        // url: url,
        dataType: 'json',
        type: "GET",
        delay: 500,
        data: function(params) {
          return {
            s: params.term, // search term
            page: params.page,
          };
        },
        processResults: function(data, params) {
          params.page = params.page || 1;
          options = data.items;
          return {
            results: data.items,
            pagination: {
              more: (params.page * 10) < data.total_count
            },
          }
        }
      },
      // formatSelection: formatItem,
      // templateResult: formatItem,
      // escapeMarkup: function(markup) {
      //   return markup;
      // },
    });
    $('.ajaxselect').on("select2:select", function(e) {
      var id = $(this).val();
      var result = $.grep(options, function(e) {
        return e.id == id;
      });
      if (result.length != 0) {
        $("input[name=uprice]").val(result[0].uprice);
        $("select#product").trigger('change');
      }
    });
  };

  // function formatItem(item) {
  //   console.log(item)
  //   if (item.loading) return item.name || item.text;
  //   var markup = '<div class="clearfix" data-uprice=' + item.uprice + '>' + item.text + '</div>';
  //   return markup;
  // }

  $(function() {
    setInterval(function() {
      var d = new Date();
      var nmonth = d.getMonth() + 1,
        nday = d.getDate(),
        nyear = d.getYear();
      if (nyear < 1000) nyear += 1900;
      var nhour = d.getHours(),
        nmin = d.getMinutes(),
        nsec = d.getSeconds();
      if (nmonth <= 9) nmonth = "0" + nmonth;
      if (nday <= 9) nday = "0" + nday;
      if (nmin <= 9) nmin = "0" + nmin;
      if (nsec <= 9) nsec = "0" + nsec;
      $('.clock').html(nday + "." + (nmonth) + "." + nyear + "<br/>" + nhour + ":" + nmin + ":" + nsec);
    }, 1000);
  });
});
