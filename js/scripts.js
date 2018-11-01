var modal = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];

prepare_table();

function prepare_table() {
  var tf;
  $.ajax({
    'url': 'php/mongoget.php',
    'dataType': 'JSON',
    'success': function (data) {
      var row = "";
      var filtersConfig = {
        base_path: 'tablefilter/',
        //col_0: 'select',
        col_1: 'select',
        col_2: 'select',
        col_3: 'select',
        col_4: 'select',
        col_5: 'select',
        col_6: 'select',
        col_7: 'select',
        col_8: 'select',
        col_9: 'select',
        col_10: 'select',
        col_11: 'select',
        filters_row_index: 2,
        headers_row_index: 1,
        alternate_rows: true,
        rows_counter: true,
        btn_reset: true,
        loader: true,
        status_bar: true,
        mark_active_columns: true,
        highlight_keywords: true,
        col_types: [
          'string', 'string', 'string',
          'string', 'number', 'number',
          'string', 'number', 'number'
        ],
        extensions: [{
          name: 'sort'
        }]
      };

      data.forEach(el => {
        if (el.Configuration.Planned.Version == el.Configuration.Currently.Version) {
          color = "#03730030"
        } else {
          color = "#b300003d"
        }

        var t = `
          <tr style='background-color:${color}' class='tablerows'>
            <td> ${el.Equipment["Item Id"]} </td>
            <td> ${el.Equipment.Station} </td>
            <td> ${el.Equipment.Line} </td>
            <td> ${el.Equipment["TOB Relation"]} </td>
            <td> ${el.Configuration.Planned.Version} </td>
            <td> ${el.Configuration.Planned.Baseline} </td>
            <td> ${el.Configuration.Planned.Checksum} </td>
            <td> ${el.Configuration.Currently.Version} </td>
            <td> ${el.Configuration.Currently.Baseline} </td>
            <td> ${el.Configuration.Currently.Date} </td>
            <td> ${el.Configuration.Currently.Person} </td>
            <td> ${el.Configuration.Currently.Checksum} </td>

            <td> ${JSON.stringify(el.Configuration.Previously)} </td>
          </tr>`;
        $("#tablebody").append(t)
      });

      tf = new TableFilter('filtertable', 2, filtersConfig);
      tf.init();
      setEventHandlers();
    },
    'error': function (data) {
      console.log("Error");
    }
  })
}

function setEventHandlers() {
  $(".tablerows").click(function () {
    $(this).css('background-color', '#ffdc61');
    modal.style.display = "block";
  });

  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}
