<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bbyellow leading-tight">
            {{ __('Chart Dashboard') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 text-center"
            role="alert">
            {{ session('status') }}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-alert">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row w-full mb-8">
                <div class="w-full md:w-1/2 p-4">
                    <canvas id="dailyIncomeExpenseChart"></canvas>
                </div>
                <div class="w-full md:w-1/2 p-4">
                    <canvas id="dailyProfitChart"></canvas>
                </div>
            </div>
            <div class="flex flex-col md:flex-row w-full mb-8">
                <div class="w-full md:w-1/2 p-4">
                    <canvas id="weeklyIncomeExpenseChart"></canvas>
                </div>
                <div class="w-full md:w-1/2 p-4">
                    <canvas id="weeklyProfitChart"></canvas>
                </div>
            </div>
            <div class="flex flex-col md:flex-row w-full mb-8">
                <div class="w-full md:w-1/2 p-4">
                    <canvas id="monthlyIncomeExpenseChart"></canvas>
                </div>
                <div class="w-full md:w-1/2 p-4">
                    <canvas id="monthlyProfitChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Income and Expense Chart
        var ctx = document.getElementById('monthlyIncomeExpenseChart').getContext('2d');
        var monthlyIncomes = @json($monthlyIncomes);
        var monthlyExpenses = @json($monthlyExpenses);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyIncomes.map(item => item.month),
                datasets: [{
                        label: 'Monthly Income',
                        data: monthlyIncomes.map(item => item.total),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Monthly Expense',
                        data: monthlyExpenses.map(item => item.total),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Monthly Profit Chart
        var ctx = document.getElementById('monthlyProfitChart').getContext('2d');
        var monthlyData = @json($monthlyProfit);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyData.map(item => item.month),
                datasets: [{
                    label: 'Monthly Profit',
                    data: monthlyData.map(item => item.profit),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Weekly Income and Expense Chart
        var ctx = document.getElementById('weeklyIncomeExpenseChart').getContext('2d');

        var weeklyIncomes = @json($weeklyIncomes);
        var weeklyExpenses = @json($weeklyExpenses);

        console.log('Weekly Incomes:', weeklyIncomes);
        console.log('Weekly Expenses:', weeklyExpenses);

        // Restructure weeklyIncomes to match weeklyExpenses if necessary
        var restructuredWeeklyIncomes = weeklyExpenses.map(expense => {
            var matchingIncome = weeklyIncomes.find(income => income.week === expense.week);
            return {
                week: expense.week,
                total: matchingIncome ? matchingIncome.total : 0
            };
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: weeklyExpenses.map(item => 'Week ' + item.week),
                datasets: [{
                        label: 'Weekly Income',
                        data: restructuredWeeklyIncomes.map(item => item.total),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    },
                    {
                        label: 'Weekly Expense',
                        data: weeklyExpenses.map(item => item.total),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toFixed(2);
                            }
                        }
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += parseFloat(tooltipItem.value).toFixed(2);
                            return label;
                        }
                    }
                }
            }
        });

        // Daily Income and Expense Chart
        var ctx = document.getElementById('dailyIncomeExpenseChart').getContext('2d');

        var dailyIncomes = @json($dailyIncomes);
        var dailyExpenses = @json($dailyExpenses);

        console.log('Daily Incomes:', dailyIncomes);
        console.log('Daily Expenses:', dailyExpenses);

        // Restructure dailyIncomes to match dailyExpenses if necessary
        var restructuredDailyIncomes = dailyExpenses.map(expense => {
            var matchingIncome = dailyIncomes.find(income => income.day === expense.day);
            return {
                day: expense.day,
                total: matchingIncome ? matchingIncome.total : 0
            };
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dailyExpenses.map(item => item.day),
                datasets: [{
                        label: 'Daily Income',
                        data: restructuredDailyIncomes.map(item => item.total),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    },
                    {
                        label: 'Daily Expense',
                        data: dailyExpenses.map(item => item.total),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value.toFixed(2);
                            }
                        }
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += parseFloat(tooltipItem.value).toFixed(2);
                            return label;
                        }
                    }
                }
            }
        });

        // Helper function to format numbers
        function formatNumber(value) {
            return parseFloat(value).toFixed(2);
        }

        // Common chart options
        const profitChartOptions = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return formatNumber(value);
                        }
                    }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += formatNumber(tooltipItem.value);
                        return label;
                    }
                }
            }
        };
        // Weekly Profit Chart
        var ctx = document.getElementById('weeklyProfitChart').getContext('2d');
        var weeklyData = @json($weeklyProfit);

        console.log('Weekly Profit Data:', weeklyData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: weeklyData.map(item => 'Week ' + item.week),
                datasets: [{
                    label: 'Weekly Profit',
                    data: weeklyData.map(item => item.profit),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: profitChartOptions
        });

        // Daily Profit Chart
        var ctx = document.getElementById('dailyProfitChart').getContext('2d');
        var dailyData = @json($dailyProfit);

        console.log('Daily Profit Data:', dailyData);

        new Chart(ctx, {
            type: 'bar', // Changed to bar to match weekly profit chart
            data: {
                labels: dailyData.map(item => item.day),
                datasets: [{
                    label: 'Daily Profit',
                    data: dailyData.map(item => item.profit),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Added transparency to match weekly chart
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: profitChartOptions
        });
    </script>
</x-app-layout>
