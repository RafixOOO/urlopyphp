<?php

$host = "10.100.100.48";   // Adres hosta bazy danych
$port = "5432";        // Port bazy danych (domyślnie 5432)
$dbname = "punktualnik_db";      // Nazwa bazy danych
$user = "postgres";    // Nazwa użytkownika bazy danych
$password = "sa"; // Hasło użytkownika

// Łączenie z bazą danych
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . pg_last_error());
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="building-dash.svg">
        <title>Urlopy</title>
        <!-- CSS -->
        <link rel="stylesheet" href="src/css/rescalendar.css">

        <style>

            /* Zmiana koloru tła dla dni zdarzeń */

/* Dodanie dolnego obramowania dla każdej komórki danych */
.rescalendar_table .rescalendar_data_rows td {
    border-bottom: 1px solid #000;
}

/* Zmiana koloru tła dla komórki dzisiejszego dnia */
.rescalendar_table .rescalendar_data_rows td.today {
    background-color: red;
    color: white;
}

/* Zmiana koloru obramowania dla komórki "middleDay" */
.rescalendar_table .rescalendar_data_rows td.middleDay {
    border: 1px solid blue;
}

            body{
                text-align: center;
                font-family: 'Roboto';
                background-color: #fafafa;
            }

            h1{
                margin: 150px 0 100px 30px;
            }

            h4{
                margin: 60px 0 10px 60px;
            }

            .wrapper{
                width: 100%;
                text-align: center;
            }

            .redded{
                background: rgb(226, 85, 85);
            }

            :root {
  --background-gradient: linear-gradient(178deg, #ffff33 10%, #3333ff);
  --gray: #34495e;
  --darkgray: #2c3e50;
}

select {
  /* Reset Select */
  appearance: none;
  outline: 10px red;
  border: 0;
  box-shadow: none;
  /* Personalize */
  flex: 1;
  padding: 0 1em;
  color: #fff;
  background-color: var(--darkgray);
  background-image: none;
  cursor: pointer;
}
/* Remove IE arrow */
select::-ms-expand {
  display: none;
}
/* Custom Select wrapper */
.select {
  position: relative;
  display: flex;
  width: 20em;
  height: 3em;
  border-radius: .25em;
  overflow: hidden;
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 1em;
  background-color: #34495e;
  transition: .25s all ease;
  pointer-events: none;
}
/* Transition */
.select:hover::after {
  color: #f39c12;
}

/* CSS */
.button-19 {
  appearance: button;
  background-color: #1899D6;
  border: solid transparent;
  border-radius: 16px;
  border-width: 0 0 4px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: din-round,sans-serif;
  font-size: 15px;
  font-weight: 700;
  letter-spacing: .8px;
  line-height: 20px;
  margin: 0;
  outline: none;
  overflow: visible;
  padding: 4px 6px;
  text-align: center;
  text-transform: uppercase;
  touch-action: manipulation;
  transform: translateZ(0);
  transition: filter .2s;
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
  white-space: nowrap;
  width: 20%;
}

.button-19:after {
  background-clip: padding-box;
  background-color: #1CB0F6;
  border: solid transparent;
  border-radius: 16px;
  border-width: 0 0 4px;
  bottom: -4px;
  content: "";
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  z-index: -1;
}

.button-19:main,
.button-19:focus {
  user-select: auto;
}

.button-19:hover:not(:disabled) {
  filter: brightness(1.1);
  -webkit-filter: brightness(1.1);
}

.button-19:disabled {
  cursor: auto;
}
.rescalendar_table{
    width:100%;
}

.rescalendar_table tbody {
    border-bottom: 1px solid #ccc;
    font-size:16px;
    
}

.rescalendar_day_cells{
    position: sticky; 
    top: -1px;
}

        </style>

    </head>

   <h4>Urlopy</h4>


  <body>
    <!-- 2024 Created by: Rafał Pezda-->
<!-- link: https://github.com/RafixOOO -->
<div style="margin-left: 2%;" class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
        <label class="btn btn-outline-primary" for="btnradio1">Administracja</label>

    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio2">Produkcja</label>

        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radioButtons = document.querySelectorAll('input[name="btnradio"]');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.id === 'btnradio1') {
                        window.location.href = 'index.php';
                    } else if (this.id === 'btnradio2') {
                        window.location.href = 'pracownik.php';
                    }
                });
            });
        });
    </script>

            <div class="rescalendar" id="my_calendar_en"></div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
        <script src="src/js/rescalendar.js"></script>
        <script>

const currentDate = new Date();

// Uzyskanie komponentów daty
const year = currentDate.getFullYear();
const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Miesiące są indeksowane od 0, dlatego dodajemy 1
const day = String(currentDate.getDate()).padStart(2, '0');

// Sformatowanie daty w formacie "YYYY-MM-DD"
const formattedDate = `${year}-${month}-${day}`;

            $(function(){

                $('#my_calendar_en').rescalendar({
                    id: 'my_calendar_pl',
                    format: 'YYYY-MM-DD',
                    refDate: formattedDate,
                    jumpSize: 7,
                    calSize: 16,
                    disabledWeekDays: [0,6],
                    data: [
                        <?php 

     // Oblicz datę 3 miesiące przed aktualną datą
     $dateFrom = date('Y-m-d', strtotime('-6 months'));
    
     // Oblicz datę 3 miesiące po aktualnej dacie
     $dateTo = date('Y-m-d', strtotime('+2 months'));

    $query = "SELECT data_od, data_do, login, imie, nazwisko, idx_dzialu, typ_absencji
    FROM rcp.absencje aa
    INNER JOIN public.users users ON users.idx_osoby = aa.idx_osoby
    WHERE (idx_dzialu = 50 or
       idx_dzialu = 54 or
       idx_dzialu = 43 or
       idx_dzialu = 44 or
       idx_dzialu = 45 or
       idx_dzialu = 47 or
       idx_dzialu = 60 or
       idx_dzialu = 46 or
       idx_dzialu = 66 or
       idx_dzialu = 70 or
       idx_dzialu = 74)
    AND (data_od > '$dateFrom' AND data_do < '$dateTo') order By imie ASC";

    $result = pg_query($conn, $query);

    if (!$result) {
        die("Błąd zapytania: " . pg_last_error($conn));
    }
    while ($row = pg_fetch_assoc($result)) {
      $customClass = ($row['typ_absencji'] == 54) ? 'table-info text-dark' : 'table-danger text-dark';
      $nazwa= ($row['typ_absencji'] == 54) ? 'Plan urlopowy' : 'Urlop';
      $data = array(
        'id' => 1,
        'name' => $row['nazwisko'] . ' ' . $row['imie'],
        'startDate' => $row['data_od'],
        'endDate' => $row['data_do'],
        'customClass' => $customClass,
        'title' => $nazwa
      );
      echo json_encode($data) . ",";
    }

?>
                    ],

                    dataKeyField: 'name',
                    dataKeyValues: [<?php
                         $query = "SELECT distinct nazwisko,imie FROM public.users where aktywny=true and (idx_dzialu = 50 or
                         idx_dzialu = 54 or
                         idx_dzialu = 43 or
                         idx_dzialu = 44 or
                         idx_dzialu = 45 or
                         idx_dzialu = 47 or
                         idx_dzialu = 60 or
                         idx_dzialu = 46 or
                         idx_dzialu = 66 or
                         idx_dzialu = 70 or
                         idx_dzialu = 74) order by nazwisko ASC";
           
               $result = pg_query($conn, $query);
           
               if (!$result) {
                   die("Błąd zapytania: " . pg_last_error($conn));
               }
               while ($row = pg_fetch_assoc($result)) {
                    echo "
                        '$row[nazwisko] $row[imie]',
                        ";

                }
            
                    ?>]
                });




            });

            var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

        </script>

    </body>

</html>
