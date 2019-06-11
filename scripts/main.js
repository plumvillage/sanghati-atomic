/* ==========================================================================
   Cards
   ========================================================================== */

const cards = document.querySelectorAll('.ugb-card')

// Open the link when the card is clicked
for (let i = 0; i < cards.length; i++) {
  cards[i].addEventListener('click', event => {
    const button = event.currentTarget.querySelector('.ugb-button')
    if (button !== null) {
      window.open(button.href, '_self')
    }
  })
}
