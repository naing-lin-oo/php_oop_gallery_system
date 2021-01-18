  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- WYSIWYG TEXT EDITOR WEB SCRIPT LINK-->
    <script src="https://cdn.tiny.cloud/1/i1o2qp61u348pmvxlj7vzwiiwcqshdu3t484u4lobmkg3669/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="js/dropzone.js"></script>

    <!-- WYSIWYG TEXT EDITOR JS FILE SCRIPT LINK-->
    <script src="js/scripts.js"></script>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['View',     <?php echo $session->count; ?>],
          ['Comments',    <?php echo Comment::count_all(); ?>],
          ['Users',  <?php echo User::count_all(); ?>],
          ['Photo', <?php echo Photo::count_all(); ?>],
        ]);

        var options = {
          legend: 'none',
          pieSliceText: 'label',
          title: 'My Daily Activities',
          backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
