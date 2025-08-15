const prayTimes = new PrayTimes('DepagRI');

function render() {
  const lat = parseFloat(document.getElementById('lat').value);
  const lng = parseFloat(document.getElementById('lng').value);
  const tbody = document.querySelector('#timetable tbody');
  tbody.innerHTML = '';

  const today = new Date();
  const daysInMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();

  for (let d = 1; d <= daysInMonth; d++) {
    const date = new Date(today.getFullYear(), today.getMonth(), d);
    const times = prayTimes.getTimes(date, [lat, lng], 7, 0, '24h');
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${date.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric' })}</td>
      <td>${times.fajr}</td>
      <td>${times.sunrise}</td>
      <td>${times.dhuhr}</td>
      <td>${times.asr}</td>
      <td>${times.maghrib}</td>
      <td>${times.isha}</td>
    `;
    tbody.appendChild(tr);
  }
}

// auto render saat load
render();

