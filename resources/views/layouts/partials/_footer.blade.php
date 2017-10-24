<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/js/scripts.js"></script>
<?php
        if(is_array($scriptJs)) {
            foreach ($scriptJs as $item) {
                echo "<script type=\"text/javascript\" src=\"/js/". $item . "\" ></script>";
            }
        } else {
            echo "<script type=\"text/javascript\" src=\"/js/". $scriptJs . "\" ></script>";
        }
?>

@if (isset($charts))
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script type="text/javascript" src="https://www.highcharts.com/samples/data/usdeur.js"></script>
@endif