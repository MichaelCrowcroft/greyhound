<script setup>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip,Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

const props = defineProps({
    company: Object
})

const chartData = {
    labels: props.company.lighthouse_reports.map(({ created_at }) => new Date(created_at).toDateString()),
    datasets: [
        {
            label: 'Performance',
            backgroundColor: '#ff0000',
            borderColor: '#ff0000',
            data: props.company.lighthouse_reports.map(({ performance }) => performance)
        },
        {
            label: 'SEO',
            backgroundColor: '#00ff00',
            borderColor: '#00ff00',
            data: props.company.lighthouse_reports.map(({ seo }) => seo)
        },
        {
            label: 'Accessibility',
            backgroundColor: '#0000ff',
            borderColor: '#0000ff',
            data: props.company.lighthouse_reports.map(({ accessibility }) => accessibility)
        },
        {
            label: 'Best Practices',
            backgroundColor: '#f0f000',
            borderColor: '#f0f000',
            data: props.company.lighthouse_reports.map(({ best_practices }) => best_practices)
        }
    ],
    tension: 0.1,

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
