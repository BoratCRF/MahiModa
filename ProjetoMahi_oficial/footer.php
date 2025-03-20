<!-- FOOTER -->
<link rel="stylesheet" href="style.css">

<footer id="fot-04" class="pt-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-3 col-xl-3 px-4">
                <img loading="lazy" src="https://sibnext.com/Repositorio/IA/12524/Logo/logo3.0.webp" alt="Logo" class="logo_rodape" style="width: 100%;">
            </div>
            <div class="col-12 col-sm-12 col-md-6 px-4">
                <h5 class="footer-title"> FALE CONOSCO </h5>
                <div id="ctl00_ControlFooter_ControlPaginaInformativa_conteudo" class="container_conteudo_informativo" style="position: relative; max-width: 100%;" data-cid="J+jzs7xXxlLlCSmhRTTRxXxlLlCSo9cU6enHH5h4diBkLYfMGx2BzVlc1pkqK35+lC5pm8uPnbcrJ8RPeYBWmJ3wbqcRsEH7GLHe4b1FHjIJVElJPANet7Z2Ce0UQj1vhUHhCT5KNqYWRwUEnelvOCoX4NVEeFbzUCqM3GPENizwTWGpwNxXxlLlCSbq6nTwwPJEZf81hFL1L8hD3bADsGJRkPaWyWwkyVAs5WGcM9KIf9dj4609yq7dC2i26GP7mNGRWlCVtXsNgfUCgU3DA4OmRQfWORJB0DHC+KqqAIAsjp2cxXxlLlCSq9bh7mR3278Sy7v9Npktweupnf8F509f5Vs2ExopDTkkKKUxlgxeljxx">
                    <p>Converse conosco para um estilo exclusivo!
                        Obtenha um orçamento personalizado para roupas e acessórios exclusivos. Deixe-nos ajudá-lo a expressar seu estilo único.</p>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3 col-xl-3 px-4">
                <h5 class="footer-title">Contato</h5>
                <p><a class="emailFooter" href="mailto:mahimoda@gmail.com">mahimoda@gmail.com</a>
                </p>
                <p><span class="telefoneFooter">21987654321</span></p>
                <div class="fot-04-social flex-wrap d-flex mt-3">

                    <div class="redeSocial">
                        <a href="https://www.facebook.com" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                    <p>&copy; 2024 - Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- whats em java-->
    <script async="" type="text/javascript" src="//wurfl.io/wurfl.js"></script>
    <script>
        var zap_telefone = '5521987654321';
        var zap_mensagem = 'Olá, gostaria de mais informações';
        var zap_exibirPulsar = eval(('True').toLowerCase());
        var zap_apresentarContato = eval(('True').toLowerCase());

        function detectarDispositivoPrincipal() {
            let linkRedirecionamentoWhatsapp = "";

            if (zap_apresentarContato) {
                linkRedirecionamentoWhatsapp = ('https://wa.me/' + zap_telefone + '?text=' + zap_mensagem);
            } else {
                if (WURFL.is_mobile) {
                    linkRedirecionamentoWhatsapp = ('https://api.whatsapp.com/send?phone=' + zap_telefone + '&text=' + zap_mensagem);
                } else {
                    linkRedirecionamentoWhatsapp = ('https://web.whatsapp.com/send?phone=' + zap_telefone + '&text=' + zap_mensagem);
                }
            }

            if (typeof GoogleAds_HashWhatsapp != "undefined" && GoogleAds_HashWhatsapp.length > 0) {
                GoogleAds_gtag_report_conversion(linkRedirecionamentoWhatsapp, GoogleAds_HashWhatsapp);
            } else {
                window.open(linkRedirecionamentoWhatsapp, '_blank');
            }
        }
    </script>
    <span id="whats_flutuante">
        <div class="btnZap"><span onclick="javascript:detectarDispositivoPrincipal()">
                <section class="tada infinite animated" data-wow-duration="2s" style="z-index: 999999999; visibility: visible; animation-duration: 2s; animation-name: whatsapp-anim; color: #fff;">
                    <img loading="lazy" alt="WhatsApp" src="https://www.c2tiapps.com//Plugins/WhatsappIcon/imagens/whats1.png" style="max-width: 80px;">
                </section>
            </span></div>
    </span>
    <script>
        $('#whats_flutuante').append('<div class="btnZap">' +
            '<span onclick="javascript:detectarDispositivoPrincipal()">' +
            (zap_exibirPulsar ? '<section class="tada infinite animated" data-wow-duration="2s" style="z-index: 999999999; visibility: visible; animation-duration: 2s; animation-name: whatsapp-anim; color: #fff;"><img loading="lazy" alt="WhatsApp" src="https://www.c2tiapps.com//Plugins/WhatsappIcon/imagens/whats1.png" style="max-width: 80px;"/></section>' :
                '<section style="z-index: 999999999; visibility: visible; color: #fff;"><img loading="lazy" src="https://www.c2tiapps.com//Plugins/WhatsappIcon/imagens/whats1.png" style="max-width: 80px;" alt="WhatsApp"/></section>'
            ) +
            '</span>' +
            '</div>');
    </script>
</footer>