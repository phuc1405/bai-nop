// Sidebar Toggle
const sidebar = document.querySelector(".sidebar");
const main = document.querySelector(".main");
const toggle = document.getElementById("toggleSidebar");

if (toggle) {
    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        main.classList.toggle("expand");
    });
}

// Đồng hồ
function updateClock() {
    const now = new Date();

    const time =
        now.toLocaleDateString("vi-VN") +
        " " +
        now.toLocaleTimeString("vi-VN");

    const clock = document.getElementById("clock");

    if (clock) {
        clock.innerHTML = time;
    }
}

setInterval(updateClock, 1000);
updateClock();

// Chart
// Chart
const importData = window.importData || [0,0,0,0,0,0,0];
const exportData = window.exportData || [0,0,0,0,0,0,0];
const ctx = document.getElementById("warehouseChart");

if (ctx) {

    new Chart(ctx, {

        type: "bar",

        data: {
            labels: window.chartLabels || [],

            datasets: [
                {
                    label: "Nhập kho",
                    data: importData,
                    backgroundColor: "#16A34A"
                },
                {
                    label: "Xuất kho",
                    data: exportData,
                    backgroundColor: "#DC2626"
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 50,
                    ticks: {
                        stepSize: 10
                    }
                }
            }
        }

    });

}
         
    

