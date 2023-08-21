<?php $menu[$this->namePage] = 'active' ?>
            <footer>
                <?php $more = mysqli_fetch_assoc($this->data->query("SELECT * FROM `tb_moreContents` WHERE `idMore` = 'more-23122112736-00001'")); if($more['visibility'] == 'y' && $this->namePage != 'contact'){ ?>
                <div class='formore'>
                    <div class='content'>
                        <div class='left'>
                            <?php  ?>
                            <img src='<?php echo urlBase, 'assets/img/', $more['img'] ?>' alt='For More Image'/>
                            <div class='block'>
                                <span class='title'><?php echo $more['title'] ?></span>
                                <span class='desc'><?php echo $more['content'] ?></span>
                            </div>
                        </div>
                        <a href='<?php echo urlBase ?>pages/contact'>Kirim Pesan<i class='micon'>forward_to_inbox</i></a>
                    </div>
                </div>
                <?php } unset($more); ?>
                <div class='part-1'>
                    <div class='content'>
                        <div class='left'>
                            <span class='title'><?php echo $this->setting['company'] ?></span>
                            <span class='desc'><?php echo $this->setting['desc'] ?></span>
                        </div>
                        <div class='right'>
                            <div class='menu'>
                                <div class='block'>
                                    <span class='title'>Informasi</span>
                                    <ul>
                                    <?php $sql = $this->data->query("SELECT `name`, `onMenu`, `url` FROM `tb_pages` WHERE `visibility` = 'y' ORDER BY `order` DESC");
                                    while($db = mysqli_fetch_assoc($sql)){ ?>
                                        <li class="<?php echo (isset($menu[$db['name']])) ? $menu[$db['name']] : '' ?>"><a href='<?php echo urlBase, $db['url'] ?>'><?php echo $db['onMenu'] ?></a></li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <div class='block'>
                                    <span class='title'>Layanan Kami</span>
                                    <ul>
                                    <?php $sql = $this->data->query("SELECT `title`, `url` FROM `tb_subpages` ORDER BY `order` DESC LIMIT 6");
                                    while($db = mysqli_fetch_assoc($sql)){ ?>
                                        <li><a href='<?php echo urlBase.'pages/sub/service/'.$db['url'] ?>'><?php echo $db['title'] ?></a></li>
                                    <?php } unset($sql, $db) ?>
                                    </ul>
                                </div>
                            </div>
                            <div class='contact'>
                                <span class='title'>Contact Us</span>
                                <div class='item'>
                                    <i class='micon'>location_on</i>
                                    <span><?php echo $this->setting['address'] ?></span>
                                </div>
                                <div class='item'>
                                    <i class='micon'>query_builder</i>
                                    <span><?php echo $this->setting['officeOpen'] ?></span>
                                    <span><?php echo $this->setting['officeClose'] ?></span>
                                </div>
                                <div class='item'>
                                    <i class='micon'>call</i>
                                    <span><?php echo $this->setting['phone'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='part-2'>
                    <div class='content'>
                        <div class='left'>&copy; <?php echo date('Y'), ' oleh ', $this->setting['company'] ?> <br/>All right reserved.</div>
                        <div class='right'>
                            <a href='<?php echo $this->setting['youtube'] ?>' target='_blank'>
                                <svg width='87' height='74' viewBox='0 0 87 74' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M43.3333 0C29.38 0 11.2695 3.49609 11.2695 3.49609L11.224 3.54818C4.86888 4.56455 0 10.0254 0 16.6667V36.6667V36.6732V56.6667V56.6732C0.00620151 59.845 1.1429 62.9106 3.20599 65.3198C5.26909 67.7289 8.12343 69.3237 11.2565 69.8177L11.2695 69.8372C11.2695 69.8372 29.38 73.3398 43.3333 73.3398C57.2867 73.3398 75.3971 69.8372 75.3971 69.8372L75.4036 69.8307C78.5401 69.3377 81.3977 67.7417 83.4624 65.3297C85.5271 62.9177 86.6633 59.8482 86.6667 56.6732V56.6667V36.6732V36.6667V16.6667C86.662 13.4938 85.526 10.4265 83.4628 8.01603C81.3996 5.60554 78.5443 4.00984 75.4102 3.51562L75.3971 3.49609C75.3971 3.49609 57.2867 0 43.3333 0ZM33.3333 21.3281L60 36.6667L33.3333 52.0052V21.3281Z'/></svg>
                            </a>

                            <a href='<?php echo $this->setting['instagram'] ?>' target='_blank'>
                                <svg width='80' height='80' viewBox='0 0 80 80' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M23.3268 0C10.4635 0 0 10.4732 0 23.3398V56.6732C0 69.5365 10.4732 80 23.3398 80H56.6732C69.5365 80 80 69.5268 80 56.6602V23.3268C80 10.4635 69.5268 0 56.6602 0H23.3268ZM63.3333 13.3333C65.1733 13.3333 66.6667 14.8267 66.6667 16.6667C66.6667 18.5067 65.1733 20 63.3333 20C61.4933 20 60 18.5067 60 16.6667C60 14.8267 61.4933 13.3333 63.3333 13.3333ZM40 20C51.03 20 60 28.97 60 40C60 51.03 51.03 60 40 60C28.97 60 20 51.03 20 40C20 28.97 28.97 20 40 20ZM40 26.6667C36.4638 26.6667 33.0724 28.0714 30.5719 30.5719C28.0714 33.0724 26.6667 36.4638 26.6667 40C26.6667 43.5362 28.0714 46.9276 30.5719 49.4281C33.0724 51.9286 36.4638 53.3333 40 53.3333C43.5362 53.3333 46.9276 51.9286 49.4281 49.4281C51.9286 46.9276 53.3333 43.5362 53.3333 40C53.3333 36.4638 51.9286 33.0724 49.4281 30.5719C46.9276 28.0714 43.5362 26.6667 40 26.6667V26.6667Z'/></svg>
                            </a>

                            <a href='<?php echo $this->setting['facebook'] ?>' target='_blank'>
                                <svg width='74' height='74' viewBox='0 0 74 74' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M66.6667 0H6.66667C2.98333 0 0 2.98333 0 6.66667V66.6667C0 70.35 2.98333 73.3333 6.66667 73.3333H40V43.3333H30V33.3333H40V27.9633C40 17.7967 44.9533 13.3333 53.4033 13.3333C57.45 13.3333 59.59 13.6333 60.6033 13.77V23.3333H54.84C51.2533 23.3333 50 25.2267 50 29.06V33.3333H60.5133L59.0867 43.3333H50V73.3333H66.6667C70.35 73.3333 73.3333 70.35 73.3333 66.6667V6.66667C73.3333 2.98333 70.3467 0 66.6667 0Z'/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
        <script>
            var scroll = window.requestAnimationFrame || function (callback){ window.setTimeout(callback, 1000 / 60) };
            var elementsToShow = document.querySelectorAll('.show-on-scroll');

            function loop() {
                Array.prototype.forEach.call(elementsToShow, function (element){
                    if (isElementInViewport(element)) {
                        element.classList.add('is-visible');
                    }
                });
                scroll(loop);
            }

            loop();

            function isElementInViewport(el) {
                if (typeof jQuery === "function" && el instanceof jQuery) {
                    el = el[0];
                }
                var rect = el.getBoundingClientRect();
                return((rect.top <= 0 && rect.bottom >= 0) || (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) && rect.top <= (window.innerHeight || document.documentElement.clientHeight)) || (rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)));
            }
        </script>
    </body>
</html>