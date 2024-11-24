
//ders9
const modal = document.getElementById('modal');

modal.classList.add('show');

setTimeout(() => {
  modal.classList.remove('show');
}, 5000); // 5 saniye sonra kapanacak


//ders9 canvas
const canvas = document.getElementById('myCanvas');
    const ctx = canvas.getContext('2d');

    const colors = [
        '#FF5733', '#33FF57', '#3357FF', '#FF33A6', '#FFFF33', 
        '#800080', '#008080', '#FF4500', '#FFD700', '#00FF7F', 
        '#4682B4', '#D2691E', '#A0522D', '#5F9EA0', '#FF6347', 
        '#ADFF2F', '#8B0000', '#20B2AA', '#FF1493', '#7CFC00', 
        '#DC143C', '#4B0082', '#DAA520', '#00CED1', '#6A5ACD', 
        '#B0E0E6', '#FF8C00', '#FA8072', '#9ACD32', '#F08080'  
      ];
    const size = 50; // Her karenin boyutu

    for (let row = 0; row < 10; row++) {
      for (let col = 0; col < 10; col++) {
        const color = colors[Math.floor(Math.random() * colors.length)];
        ctx.fillStyle = color;
        ctx.fillRect(col * size, row * size, size, size);
      }
    }


//ders9 sorular 
// Doğru cevaplar
const answers = {
    q1: 'b',
    q2: 'a',
    q3: 'c',
    q4: 'b',
    q5: 'b',
    q6: 'a',
    q7: 'a',
    q8: 'a',
    q9: 'a',
    q10: 'b',
};

// Skoru hesaplama fonksiyonu
function calculateScore() {
    let score = 0;
    let totalQuestions = Object.keys(answers).length;

    for (let question in answers) {
        const userAnswer = document.querySelector(`input[name="${question}"]:checked`);
        if (userAnswer && userAnswer.value === answers[question]) {
            score++;
        }
    }

    const result = document.getElementById('result');
    result.textContent = `Test Sonucu: ${score} / ${totalQuestions}`;
}
