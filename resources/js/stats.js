import Chart from 'chart.js/auto';
const orders = document.getElementById('myOrders');
const restaurants = document.getElementById('myRestaurants');
const earns = document.getElementById('myEarns');



if (orders) {


    new Chart(orders, {
        type: 'bar',
        data: {
            labels: ['2022-07', '2022-08', '2022-09', '2022-10', '2022-11', '2022-12', '2023-01', '2023-02', '2023-03', '2023-04', '2023-05', '2023-06'],
            datasets: [{
                label: 'Ordini',
                data: [],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
if (restaurants) {
    new Chart(restaurants, {
        type: 'doughnut',
        data: {
            labels: ['Il mio ristorante', 'Il mio secondo ristorante', 'il mio terzo ristorante'],
            datasets: [{
                label: 'Numero ordini',
                data: [15, 30, 4],
                borderWidth: 1
            }]
        },

    });
}
if (earns) {
    new Chart(earns, {
        type: 'line',
        data: {
            labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
            datasets: [{
                label: 'Ristorante 1',
                data: [12000, 25000, 1000, 2500, 3000, 600, 15000, 21000, 35000, 4100, 2600, 9000],
                borderWidth: 1
            },
            {
                label: 'Ristorante 2',
                data: [2000, 5000, 1000, 2500, 300, 600, 1500, 2100, 3500, 410, 2600, 9000],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

