'use strict';

window.chartColors = {
    green: '#75c181',
    gray: '#a9b5c9',
    text: '#252930',
    border: '#e7e9ed'
};

// Función para obtener datos del servidor
async function fetchChartData(url, period) {
    const response = await fetch(`${url}?period=${period}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    return response.json();
}


// Configuración del gráfico de líneas (progreso de estudiantes)
var lineChartConfig = {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Promedio de calificaciones',
            fill: false,
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            data: [],
        }]
    },
    options: {
        responsive: true,
        aspectRatio: 1.5,
        legend: {
            display: true,
            position: 'bottom',
            align: 'end',
        },
        title: {
            display: true,
            text: 'Progreso de Estudiantes',
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            titleMarginBottom: 10,
            bodySpacing: 10,
            xPadding: 16,
            yPadding: 16,
            borderColor: window.chartColors.border,
            borderWidth: 1,
            backgroundColor: '#fff',
            bodyFontColor: window.chartColors.text,
            titleFontColor: window.chartColors.text,
            callbacks: {
                label: function (tooltipItem, data) {
                    return `Calificación: ${tooltipItem.value}`;
                }
            },
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Fecha'
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Calificación Promedio'
                },
                ticks: {
                    beginAtZero: true,
                    max: 10
                }
            }]
        }
    }
};

// Configuración del gráfico de barras (ejercicios completados)
var barChartConfig = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Ejercicios Creados',
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            borderWidth: 1,
            maxBarThickness: 16,
            data: []
        }]
    },
    options: {
        responsive: true,
        aspectRatio: 1.5,
        legend: {
            position: 'bottom',
            align: 'end',
        },
        title: {
            display: true,
            text: 'Ejercicios Creados por Fecha'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            titleMarginBottom: 10,
            bodySpacing: 10,
            xPadding: 16,
            yPadding: 16,
            borderColor: window.chartColors.border,
            borderWidth: 1,
            backgroundColor: '#fff',
            bodyFontColor: window.chartColors.text,
            titleFontColor: window.chartColors.text,
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    drawBorder: false,
                    color: window.chartColors.border,
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Fecha'
                }
            }],
            yAxes: [{
                            display: true,
                            gridLines: {
                                drawBorder: false,
                                color: window.chartColors.borders,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Número de Ejercicios'
                            },
                            ticks: {
                                beginAtZero: true,
                                min: 0, // Establece el valor mínimo del eje Y en 0
                                max: 10, // Establece el valor máximo del eje Y en 10
                                stepSize: 1 // Establece el tamaño del paso en 1 para mostrar solo números enteros
                            }
                        }]
        }
    }
};


// Función para actualizar los gráficos
async function updateCharts(period) {
    try {
        // Actualizar gráfico de líneas
        const lineData = await fetchChartData('/docente/progress-chart-data', period);
        window.myLine.data.labels = lineData.labels;
        window.myLine.data.datasets[0].data = lineData.values;
        window.myLine.update();

        // Actualizar gráfico de barras
        const barData = await fetchChartData('/docente/created-exercises-data', period);
        window.myBar.data.labels = barData.labels;
        window.myBar.data.datasets[0].data = barData.values;
        window.myBar.update();
    } catch (error) {
        console.error('Error updating charts:', error);
    }
}



// Inicializar gráficos al cargar la página
window.addEventListener('load', async function () {
    var lineChart = document.getElementById('canvas-linechart').getContext('2d');
    window.myLine = new Chart(lineChart, lineChartConfig);

    var barChart = document.getElementById('canvas-barchart').getContext('2d');
    window.myBar = new Chart(barChart, barChartConfig);

    // Cargar datos iniciales
    await updateCharts('week');

    // Agregar event listeners a los selectores de período
    document.querySelectorAll('.form-select').forEach(select => {
        select.addEventListener('change', function () {
            updateCharts(this.value);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    updateCharts('week');
});
