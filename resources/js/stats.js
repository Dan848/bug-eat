import Chart from 'chart.js/auto';
const orders = document.getElementById('myOrders');
const restaurants = document.getElementById('myRestaurants');
const earns = document.getElementById('myEarns');

new Chart(orders, {
    type: 'bar',
    data: {
        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
        datasets: [{
            label: 'Ordini',
            data: [100, 10, 3, 5, 2, 3, 15, 30, 45, 23, 78, 18],
            borderWidth: 1
        },
        {
            label: 'Ordini2',
            data: [100, 10, 15, 5, 7, 8, 10, 32, 45, 23, 78, 18],
            borderWidth: 1
        },]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
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

