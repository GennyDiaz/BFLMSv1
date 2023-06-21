function createChart(rawdata){
    const ctx = document.getElementById('Mychart');
    
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Water Level',
                data: rawdata,
                borderColor: '#0d6efd',
                fill: false
            }],
            labels: rawdata.map(function(data){
                return data.x.toLocaleString()
        })
    },
        options: {
            responsive: true,
            scales:{
                x:[{
                    grid:{
                        color: '#ffffff'
                    },
                    ticks: {
                        maxRotation: 90,
                        minRotation: 90,
                        autoSkip: true,
                        maxTicksLimit: 10
                    }
                }],
                y:[{
                    border:{
                        display: false
                    },
                    grid:{
                        color: '#ffffff'
                    },
                    ticks: {
                    beginAtZero: true,
                    suggestedMin: 0
                    }
                }]

            }
        }
    });

    function updatechart(){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost/bflmsv1/data/chartdata.php", true);
        xhr.onreadystatechange = function(){

            if(this.readyState == 4 && this.status == 200){
                var newData = JSON.parse(this.responseText);   

                chart.data.datasets[0].data = newData;
                chart.data.labels = newData.map(function(data){
                    return data.x.toLocaleString();
                });
                chart.update();
            }
        };
    xhr.send();
    }
    setInterval(updatechart,100);
}
var xhr = new XMLHttpRequest();
  xhr.open("GET", "http://localhost/bflmsv1/data/chartdata.php", true);
    xhr.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        var newData = JSON.parse(this.responseText);   

        createChart(newData);
      }
    };
xhr.send();