// dashboard-charts.js - Complete Chart Implementation with Real Data

// Chart Configuration
const chartColors = {
    primary: 'rgb(59, 130, 246)',
    success: 'rgb(34, 197, 94)',
    warning: 'rgb(251, 146, 60)',
    danger: 'rgb(239, 68, 68)',
    info: 'rgb(14, 165, 233)',
    purple: 'rgb(168, 85, 247)'
};

// Global Chart Options
const globalChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
            position: 'top',
        },
        tooltip: {
            mode: 'index',
            intersect: false,
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                callback: function(value) {
                    return value.toFixed(2);
                }
            }
        }
    }
};

// Initialize all charts
let charts = {};

// 1. RADAR CHART - Overall UI GreenMetric Score
function initRadarChart(data) {
    const ctx = document.getElementById('radarChart');
    if (!ctx) return;

    if (charts.radar) charts.radar.destroy();

    charts.radar = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: [
                'Setting & Infrastructure',
                'Energy & Climate',
                'Waste Management',
                'Water Management',
                'Transportation',
                'Education & Research'
            ],
            datasets: [{
                label: 'Current Score',
                data: [
                    data.setting_infrastructure || 0,
                    data.energy_climate || 0,
                    data.waste_management || 0,
                    data.water_management || 0,
                    data.transportation || 0,
                    data.education_research || 0
                ],
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: chartColors.primary,
                borderWidth: 2,
                pointBackgroundColor: chartColors.primary,
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: chartColors.primary
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
}

// 2. BAR CHART - Criteria Comparison
function initBarChart(data) {
    const ctx = document.getElementById('barChart');
    if (!ctx) return;

    if (charts.bar) charts.bar.destroy();

    charts.bar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Setting & Infrastructure',
                'Energy & Climate',
                'Waste',
                'Water',
                'Transport',
                'Education'
            ],
            datasets: [{
                label: 'Score',
                data: [
                    data.setting_infrastructure || 0,
                    data.energy_climate || 0,
                    data.waste_management || 0,
                    data.water_management || 0,
                    data.transportation || 0,
                    data.education_research || 0
                ],
                backgroundColor: [
                    chartColors.primary,
                    chartColors.success,
                    chartColors.warning,
                    chartColors.danger,
                    chartColors.info,
                    chartColors.purple
                ],
                borderColor: [
                    chartColors.primary,
                    chartColors.success,
                    chartColors.warning,
                    chartColors.danger,
                    chartColors.info,
                    chartColors.purple
                ],
                borderWidth: 1
            }]
        },
        options: {
            ...globalChartOptions,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
}

// 3. LINE CHART - Trend Over Time
function initLineChart(data) {
    const ctx = document.getElementById('lineChart');
    if (!ctx) return;

    if (charts.line) charts.line.destroy();

    charts.line = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Overall Score',
                data: data.scores || [0, 0, 0, 0, 0, 0],
                borderColor: chartColors.primary,
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: globalChartOptions
    });
}

// 4. DOUGHNUT CHART - Score Distribution
function initDoughnutChart(data) {
    const ctx = document.getElementById('doughnutChart');
    if (!ctx) return;

    if (charts.doughnut) charts.doughnut.destroy();

    const total = (data.setting_infrastructure || 0) + 
                  (data.energy_climate || 0) + 
                  (data.waste_management || 0) + 
                  (data.water_management || 0) + 
                  (data.transportation || 0) + 
                  (data.education_research || 0);

    charts.doughnut = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Setting & Infrastructure',
                'Energy & Climate',
                'Waste',
                'Water',
                'Transport',
                'Education'
            ],
            datasets: [{
                data: [
                    data.setting_infrastructure || 0,
                    data.energy_climate || 0,
                    data.waste_management || 0,
                    data.water_management || 0,
                    data.transportation || 0,
                    data.education_research || 0
                ],
                backgroundColor: [
                    chartColors.primary,
                    chartColors.success,
                    chartColors.warning,
                    chartColors.danger,
                    chartColors.info,
                    chartColors.purple
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

// 5. POLAR AREA CHART - Alternative View
function initPolarChart(data) {
    const ctx = document.getElementById('polarChart');
    if (!ctx) return;

    if (charts.polar) charts.polar.destroy();

    charts.polar = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: [
                'Setting & Infrastructure',
                'Energy & Climate',
                'Waste',
                'Water',
                'Transport',
                'Education'
            ],
            datasets: [{
                data: [
                    data.setting_infrastructure || 0,
                    data.energy_climate || 0,
                    data.waste_management || 0,
                    data.water_management || 0,
                    data.transportation || 0,
                    data.education_research || 0
                ],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.5)',
                    'rgba(34, 197, 94, 0.5)',
                    'rgba(251, 146, 60, 0.5)',
                    'rgba(239, 68, 68, 0.5)',
                    'rgba(14, 165, 233, 0.5)',
                    'rgba(168, 85, 247, 0.5)'
                ],
                borderColor: [
                    chartColors.primary,
                    chartColors.success,
                    chartColors.warning,
                    chartColors.danger,
                    chartColors.info,
                    chartColors.purple
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
}

// Fetch data from API and initialize charts
async function loadChartData() {
    try {
        // Fetch overall scores from dashboard
        const response = await fetch('/api/dashboard/scores');
        const data = await response.json();

        // Initialize all charts
        initRadarChart(data);
        initBarChart(data);
        initDoughnutChart(data);
        initPolarChart(data);

        // Load trend data
        const trendResponse = await fetch('/api/dashboard/trend');
        const trendData = await trendResponse.json();
        initLineChart(trendData);

        // Update score display
        updateScoreDisplay(data);
    } catch (error) {
        console.error('Error loading chart data:', error);
        // Initialize with default data if fetch fails
        const defaultData = {
            setting_infrastructure: 0,
            energy_climate: 0,
            waste_management: 0,
            water_management: 0,
            transportation: 0,
            education_research: 0
        };
        
        initRadarChart(defaultData);
        initBarChart(defaultData);
        initDoughnutChart(defaultData);
        initPolarChart(defaultData);
        initLineChart({ labels: [], scores: [] });
    }
}

// Update score display in dashboard
function updateScoreDisplay(data) {
    const total = (data.setting_infrastructure || 0) + 
                  (data.energy_climate || 0) + 
                  (data.waste_management || 0) + 
                  (data.water_management || 0) + 
                  (data.transportation || 0) + 
                  (data.education_research || 0);
    
    const totalElement = document.getElementById('totalScore');
    if (totalElement) {
        totalElement.textContent = total.toFixed(2);
    }

    // Update individual criteria scores
    const criteria = [
        'setting_infrastructure',
        'energy_climate',
        'waste_management',
        'water_management',
        'transportation',
        'education_research'
    ];

    criteria.forEach(criterion => {
        const element = document.getElementById(`${criterion}_score`);
        if (element) {
            element.textContent = (data[criterion] || 0).toFixed(2);
        }
    });
}

// Auto refresh charts every 5 minutes
function startAutoRefresh() {
    setInterval(() => {
        loadChartData();
    }, 300000); // 5 minutes
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadChartData();
    startAutoRefresh();
});

// Export functions for external use
window.dashboardCharts = {
    reload: loadChartData,
    initRadar: initRadarChart,
    initBar: initBarChart,
    initLine: initLineChart,
    initDoughnut: initDoughnutChart,
    initPolar: initPolarChart
};