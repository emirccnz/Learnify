
const notificationIcon = document.querySelector('.fa-bell');
const notificationPopup = document.querySelector('.notificationPopup');

notificationIcon.addEventListener('click', () => {
  notificationPopup.style.display =
    notificationPopup.style.display === 'block' ? 'none' : 'block';
});
document.addEventListener('click', (e) => {
  if (
    !notificationIcon.contains(e.target) &&
    !notificationPopup.contains(e.target)
  ) {
    notificationPopup.style.display = 'none';
  }
});


// function bindAnswerButtons() {
//   document.querySelectorAll('.answerBtn').forEach((btn) => {
//     btn.addEventListener('click', (e) => {
    
//       const card = e.target.closest('.quest');
//       if (!card) return;
//       localStorage.setItem('selectedQuest', card.outerHTML);
//       target.parentElement.src = "../cevapla/cevapla.php?soruID=${q.soruID}"
//     });
//   });
// }


async function loadQuestions({
  dersID = '',
  search = '',
  seviye = '',
  cevap = '',
} = {}) {
  const url = new URL('fetch.php', location);
  url.searchParams.set('action', 'sorular');
  if (dersID) url.searchParams.set('dersID', dersID);
  if (search) url.searchParams.set('search', search);
  if (seviye) url.searchParams.set('seviye', seviye);
  if (cevap) url.searchParams.set('cevap', cevap);

  const res = await fetch(url);
  const qs = await res.json();
  const container = document.getElementById('soruListesi');
  container.innerHTML = '';

  qs.forEach((q) => {
   

    const card = document.createElement('div');
    card.className = 'quest';

     


    card.innerHTML = `
      <div class="content-header">
        <div class="profile">
          <img src="${q.profilFoto}" alt="Profil">
          <span>${q.kullaniciTakmaAdi}</span>
        </div>
        <div class="konu">${q.dersAdi}</div>
      </div>

      <div class="questions">
        <p class="soruLink">
      <a href="sorusayfasi.php?soruID=${q.soruID}" >
        ${q.soruAciklamasi}
      </a>
    </p>
      </div>

      <div class="answer">
        <span class="points">+${q.soruPuani} pn</span>
        <a class="answerBtn" href="../cevapla/cevapla.php?soruID=${q.soruID}">Cevapla</a>
      </div>
    `;

    container.appendChild(card);
  });


  bindAnswerButtons();
}


['filterDers', 'searchInput', 'filterSeviye', 'filterCevap'].forEach(
  (id) => {
    document
      .getElementById(id)
      .addEventListener(id === 'searchInput' ? 'input' : 'change', () => {
        loadQuestions({
          dersID: document.getElementById('filterDers').value,
          search: document.getElementById('searchInput').value,
          seviye: document.getElementById('filterSeviye').value,
          cevap: document.getElementById('filterCevap').value,
        });
      });
  }
);


document
  .getElementById('dersListesi')
  .addEventListener('click', (e) => {
    if (e.target.matches('a[data-dersid]')) {
      const chosen = e.target.dataset.dersid;
      document.getElementById('filterDers').value = chosen;
      loadQuestions({
        dersID: chosen,
        search: document.getElementById('searchInput').value,
        seviye: document.getElementById('filterSeviye').value,
        cevap: document.getElementById('filterCevap').value,
      });
    }
  });


['filterDers-mobile', 'filterSeviye-mobile', 'filterCevap-mobile'].forEach(
  (id) => {
    document
      .getElementById(id)
      .addEventListener('change', () => {
        loadQuestions({
          dersID: document.getElementById('filterDers-mobile').value,
          search: document.getElementById('searchInput').value,
          seviye: document.getElementById('filterSeviye-mobile').value,
          cevap: document.getElementById('filterCevap-mobile').value,
        });
      });
  }
);


window.addEventListener('DOMContentLoaded', () => loadQuestions());
