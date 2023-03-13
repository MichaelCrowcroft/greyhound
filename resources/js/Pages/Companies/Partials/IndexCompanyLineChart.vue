<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip,Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)
ChartJS.defaults.font.family = ['Nunito'];

const props = defineProps({
    data: Object
})

const companies = Object.keys(props.data)
const values = Object.values(Object.values(props.data)).map(item => Object.values(item).map(item => item.performance))
const colors = ['#13B5EA', '2CA01C', '#0075DD', '#2047CE', '#00D639']
const datasets = companies.map((company, index) => [{
    label: company,
    data: values[index],
    borderColor: colors[index],
    backgroundColor: colors[index],
    tension: 0.1
}]).flat()


const chartData = {
    labels: Object.keys(Object.values(props.data)[0]).map(date => new Date(date).toDateString()),
    datasets: datasets
}

const options = {
    scales: {
      y: {
            min: 0,
            max: 100
        }
    }
}
</script>

<template>
    <h3 class="mb-4 text-lg font-semibold text-center">Performance</h3>
    <Line :data="chartData" :options="options" />
</template>
