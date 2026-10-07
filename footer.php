    <!-- Модальное окно обратной связи -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h3>Оставить заявку</h3>
            <form id="feedbackForm" action="send_feedback.php" method="POST">
                <input type="hidden" name="product_id" id="product_id" value="">
                <input type="text" name="name" placeholder="Ваше имя" required>
                <input type="tel" name="phone" placeholder="Телефон" required>
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="title" placeholder="Заголовок" id="title" required></textarea>
                <textarea name="message" rows="4" placeholder="Сообщение"></textarea>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <h4>УЗГТ</h4>
                <p>Производство и модификация<br>снегоболотоходов с 2010 года</p>
            </div>
            <div class="footer-col">
                <h4>Контакты</h4>
                <a href="tel:+73432690439">+7 (343) 269-04-39</a>
                <a href="mailto:uzgt-ural@yandex.ru">uzgt-ural@yandex.ru</a>
                <p>г. Екатеринбург, ул. Заводская, 15</p>
            </div>
            <div class="footer-col">
                <h4>Навигация</h4>
                <a href="index.php">Главная</a>
                <a href="catalogue.php">Каталог</a>
                <a href="news.php">Новости</a>
                <a href="leasing.php">Лизинг</a>
            </div>
            <div class="footer-col">
                <h4>Мы в соцсетях</h4>
                <a href="https://vk.com/uzgt" target="_blank" class="social-link">ВКонтакте</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?= date('Y') ?> УЗГТ. Все права защищены.</p>
        </div>
    </footer>

    <script>
    var modal = document.getElementById('feedbackModal');
    var closeBtn = document.getElementsByClassName('modal-close')[0];

    function openFeedbackModal(productName, productId) {
        document.getElementById('product_id').value = productId;
        var messageTitle = document.querySelector('#title');
        if (messageTitle && productName) {
            messageTitle.value = 'Запрос цены на: ' + productName + '\n\n';
        }
        modal.style.display = 'flex';
    }

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var btns = document.querySelectorAll('.card-btn');
        btns.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var card = this.closest('.card');
                var productName = this.getAttribute('data-name') || 'Товар';
                var productId = this.getAttribute('data-id') || '0';
                openFeedbackModal(productName, productId);
            });
        });
    });

    
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('feedbackForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                var phoneInput = form.querySelector('input[name="phone"]');
                var phone = phoneInput.value.trim();
                
                var phonePattern = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
                
                if (!phonePattern.test(phone)) {
                    e.preventDefault();
                    alert('Введите корректный номер телефона (например: +7 912 345-67-89)');
                    phoneInput.focus();
                    return false;
                }
                return true;
            });
        }
    });

        (function() {
    const slides = document.querySelectorAll('.carousel-slide');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    const dotsContainer = document.querySelector('.carousel-dots');
    
    if (!slides.length) return;
    
    let currentIndex = 0;
    const totalSlides = slides.length;
    
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('span');
        dot.classList.add('carousel-dot');
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(i));
        dotsContainer.appendChild(dot);
    }
    
    const dots = document.querySelectorAll('.carousel-dot');
    
    function goToSlide(index) {
        slides[currentIndex].classList.remove('active');
        dots[currentIndex].classList.remove('active');
        currentIndex = index;
        slides[currentIndex].classList.add('active');
        dots[currentIndex].classList.add('active');
    }
    
    function nextSlide() {
        let newIndex = currentIndex + 1;
        if (newIndex >= totalSlides) newIndex = 0;
        goToSlide(newIndex);
    }
    
    function prevSlide() {
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = totalSlides - 1;
        goToSlide(newIndex);
    }
    
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);
    
    let autoSlide = setInterval(nextSlide, 3000);
    
    const container = document.querySelector('.carousel-carousel');
    container.addEventListener('mouseenter', () => clearInterval(autoSlide));
    container.addEventListener('mouseleave', () => {
        autoSlide = setInterval(nextSlide, 6000);
    });
    })();

    function openCartFeedbackModal(messageText, titleText = 'Заказ запчастей') {
        document.getElementById('product_id').value = '0';
        var titleField = document.querySelector('#title');
        if (titleField) {
            titleField.value = titleText;
        }
        var messageField = document.querySelector('#feedbackForm textarea[name="message"]');
        if (messageField) {
            messageField.value = messageText;
        }
        modal.style.display = 'flex';
    }
    </script>
</body>
</html>