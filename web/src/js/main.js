// import './bootstrapJS/bootstrap.js';

function columnFilter(inputSelector, tableId) {
    const input = $(inputSelector);

    input.on(
        'input',
        { tableId: tableId },
        function (e) {
            const colIdx = $(this).attr('data-filter-idx');
            const text = $(this).val().trim().toLowerCase();

            for (let i = 0; i < $(e.data.tableId + ' tbody tr').length; i++) {
                const $row = $(e.data.tableId + ' tbody tr').eq(i);

                if ($row.find('td').eq(colIdx).text().trim().toLowerCase().includes(text)) {
                    $row.show();
                } else $row.hide();
            }
        }
    )
}

if ($('#dataTable').eq(0).length) columnFilter('input.search', '#dataTable');
if ($('[data-idd]').eq(0).length) ddInput();
if ($('[data-ac]').eq(0).length) autoComplete();

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

if (tooltipTriggerList) {
    const tooltipList = [...tooltipTriggerList].map(
        tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)
    );
}

// form filter button behavior
$('.form-filter.collapse').on('show.bs.collapse', function () {
    const id = $(this).attr('id');
    $(`button[data-bs-target='#${id}']`).text('close');
})
$('.form-filter.collapse').on('hide.bs.collapse', function () {
    const id = $(this).attr('id');
    $(`button[data-bs-target='#${id}']`).text('filter');
})
// end of form filter button behavior

// custom jQuery Autocomplete widget
if ($.ui) {
    $.widget("custom.bsAutocomplete", $.ui.autocomplete, {
        _renderMenu: function (ul, items) {
            const that = this;
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
            $(ul).addClass("dropdown-menu overflow-y-auto overflow-x-hidden");
            $(ul).find('li').addClass('dd-list-item');
        }
    });

    $("#materialtraderssearch-refsystem").bsAutocomplete(acCfg('system', 'materialtraderssearch-refsystem'));
    $("#stationssearch-refsystem").bsAutocomplete(acCfg('system', 'materialtraderssearch-refsystem'));
}

function acCfg(cat, inpId) {
    return {
        source: `/search/?cat=${cat}`,
        minLength: 3,
        delay: 1000,
        focus: function (event, ui) {
            this.value = ui.item.label; // or $('#autocomplete-input').val(ui.item.label);
            event.preventDefault(); // Prevent the default focus behavior.
        },
        select: function (event, ui) {
            this.value = ui.item.label;
            $(`#${inpId}`).val(ui.item.value);
            event.preventDefault();
        },
        search: function (event, ui) {
            $('.spinner').removeClass('visually-hidden');
        },
        response: function (event, ui) {
            $('.spinner').addClass('visually-hidden');
        }
    }
}
// end of custom jQuery Autocomplete widget

$('#btn-mean-prices').on('click', function () {
    const obj = { cmd: [] };
    for (let i = 0; i < $('.c-exp-name').length; i++) {
        obj.cmd.push($('.c-exp-name').eq(i).text().trim())
    }

    $.get('http://5.35.100.223/markets/mean', obj, function (data) {
        // console.log(data);
        data.forEach(function (item) {
            const cName = item.name.toLowerCase();
            $(`td[data-name="${cName}"] > span`).text(`(${item.mean_price.toLocaleString('uk')} cr)`);
        })

        $('#btn-mean-prices').attr('disabled', true);
    })
})




