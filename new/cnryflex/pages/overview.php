<?php require dirname(__FILE__, 3).'/root.php';
require dirFlex.'system/core.php';
$core = new Core('private');
$core->open(
    array('p_overview', 'Overview'),
    array(),
    array('lib/chart')
); ?>

<section id="overview" class="top">
    <span class="title">Overview.</span>
    
    <div class="total">
        <a class="item" href="<?php echo urlFlex ?>pages/pageview.list">
            <i class="micon">remove_red_eye</i>
            <span class="title">Pageviews</span>
            <div class="bottom">
                <span class="result">0</span>
                <span class="seeMore">See More</span>
            </div>
        </a>

        <a class="item" href="javascript:void(0)">
            <i class="micon">account_circle</i>
            <span class="title">Members</span>
            <div class="bottom">
                <span class="result">0</span>
                <span class="seeMore">See More</span>
            </div>
        </a>

        <a class="item" href="javascript:void(0)">
            <i class="micon">assignment_turned_in</i>
            <span class="title">Submission</span>
            <div class="bottom">
                <span class="result">0</span>
                <span class="seeMore">See More</span>
            </div>
        </a>

        <a class="item" href="javascript:void(0)">
            <i class="micon">account_balance_wallet</i>
            <span class="title">Payment</span>
            <div class="bottom">
                <span class="result">0</span>
                <span class="seeMore">See More</span>
            </div>
        </a>
    </div>

    <div class="chart">
        <div class="left">
            <span class="title">12</span>
            <span class="tagline">Total submission for today</span>
            <span class="desc">Chart of members who have / currently submission for the last 3 days. To view complete data click the button below.</span><a href="javascript:void(0)">See entire data<i class='micon'>east</i></a>
        </div>
        <div class="right"><canvas id="ikhtisar1"></canvas></div>
    </div>

    <script>
        var ctx = document.getElementById("ikhtisar1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: { labels: ["Sunday", "Tuesday", "Wednesday"],
                datasets: [{
                    label: 'Done',
                    data: [4, 6, 10],
                    backgroundColor: '#345EFF'
                }, {
                    label: 'On Progress',
                    data: [2, 4, 14],
                    backgroundColor: '#999'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 11,
                                weight: 300,
                                family: "Poppins"
                            }
                        }
                    }
                }
            }
        });
    </script>

<?php $core->close();