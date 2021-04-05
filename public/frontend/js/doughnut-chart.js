/*==== doughut chart =====*/
var ctx = document.getElementById( "doughnut-chart" );
Chart.defaults.global.defaultFontFamily = 'Mukta';
Chart.defaults.global.defaultFontSize = 14;
Chart.defaults.global.defaultFontStyle = '500';
Chart.defaults.global.defaultFontColor = '#233d63';
var chart = new Chart( ctx, {
    type: 'doughnut',
    data: {
        datasets: [ {
            data: [ 40, 32, 15 ],
            backgroundColor: ["#7E3CF9", "#F68A03", "#358FF7"],
            hoverBorderWidth: 5,
            hoverBorderColor: "#eee",
            borderWidth: 3

        } ],
        labels: [
            "Direct Sales",
            "Referral Sales",
            "Affiliate Sales"
        ]
    },
    options: {
        responsive: true,
        tooltips: {
            xPadding: 15,
            yPadding: 15,
            backgroundColor: '#2e3d62'
        },
        legend: {
            display: false
        },
        cutoutPercentage: 70
    }
} );