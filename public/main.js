(function (window, undefined) {
  const guesses = [];

  function attachEventListeners() {
    window.document.querySelector('form.pokemon-guess').addEventListener('submit', submitGuess);
  }

  async function submitGuess(event) {
    event.preventDefault();

    const input = window.document.querySelector('input[name="name"]');
    const guess = input.value;

    if (guesses.find((g) => g === guess)) {
      console.warn(`Palpite ${guess} já foi enviado. Ignorando.`);
      guess.value = '';
      return;
    }

    guesses.push(guess);
    const html = guesses.map((guess) => `<li>${guess}</li>`).reverse().join("\n");
    window.document.querySelector('ul#guesses').innerHTML = html;

    /**
     * @TODO: Enviar palpite ao servidor e indicar sucesso/falha.
     * A variável `guess: string` é contém o valor enviado pelo usuário.
     */
  }

  async function handleContentLoaded() {
    attachEventListeners();
  }

  window.addEventListener('DOMContentLoaded', handleContentLoaded);
})(window);

