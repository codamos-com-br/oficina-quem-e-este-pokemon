(function (window, undefined) {
  const guesses = [];

  function attachEventListeners() {
    window.document.querySelector('form.pokemon-guess').addEventListener('submit', submitGuess);
  }

  async function loadMysteriousPokemon() {
    const res = await fetch('/current');

    if (res.ok) {
      const src = await res.text();
      window.document.querySelector('img.pokemon-img').src = src;
    } else {
      // Make pokemon img frame red
      window.document.querySelector('main.framed').classList.add('danger');
      window.document.querySelector('img.pokemon-img').parentElement.innerHTML = `
        <p>
          Não foi possível carregar o Pokémon de hoje.
        </p>
      `;

      // Add gray overlay to guess box
      window.document.querySelector('aside.framed').classList.add('disabled');

      // Disable guess form
      window.document.querySelector('input[name="name"]').disabled = true;
      window.document.querySelector('button[type="submit"]').disabled = true;
    }
  }

  async function submitGuess(event) {
    event.preventDefault();

    const input = window.document.querySelector('input[name="name"]');
    const guess = input.value;

    if (guesses.find((g) => g === guess)) {
      console.warn(`Guess ${guess} already submited. Ignoring.`);
      guess.value = '';
      return;
    }

    guesses.push(guess);
    const html = guesses.map((guess) => `<li>${guess}</li>`).reverse().join("\n");
    window.document.querySelector('ul#guesses').innerHTML = html;

    try {
      const res = await fetch(`/submit?guess=${guess}`, { method: 'POST' });

      if (res.ok) {
        window.document.querySelector('ul#guesses li:first-child').append(' ✅');
      }
    } catch (err) {
      console.error(`Failed to submit guess`, err);
    }
  }

  async function handleContentLoaded() {
    // await loadMysteriousPokemon();
    attachEventListeners();
  }

  window.addEventListener('DOMContentLoaded', handleContentLoaded);
})(window);

