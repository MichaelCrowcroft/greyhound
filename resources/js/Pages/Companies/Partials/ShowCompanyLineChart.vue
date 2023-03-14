<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip,Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)
ChartJS.defaults.font.family = ['Nunito'];

const props = defineProps({
    company: Object
})

const chartData = {
    labels: props.company.lighthouse_reports.map(({ created_at }) => new Date(created_at).toDateString()),
    datasets: [
        {
            label: 'Performance',
            backgroundColor: '#4d7c0f',
            borderColor: '#4d7c0f',
            data: props.company.lighthouse_reports.map(({ performance }) => performance),
            tension: 0.1
        },
        {
            label: 'SEO',
            backgroundColor: '#1d4ed8',
            borderColor: '#1d4ed8',
            data: props.company.lighthouse_reports.map(({ seo }) => seo),
            tension: 0.1
        },
        {
            label: 'Accessibility',
            backgroundColor: '#a21caf',
            borderColor: '#a21caf',
            data: props.company.lighthouse_reports.map(({ accessibility }) => accessibility),
            tension: 0.1
        },
        {
            label: 'Best Practices',
            backgroundColor: '#be123c',
            borderColor: '#be123c',
            data: props.company.lighthouse_reports.map(({ best_practices }) => best_practices),
            tension: 0.1
        }
    ],
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
    <Line :data="chartData" :options="options" />
</template>
