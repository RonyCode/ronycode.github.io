<header>
    <nav class="navbar" style="
            width: 960px;
            height: 50px;
            background-image: linear-gradient(to right top,
                    #d5d5d5,
                    #d0d2d3,
                    #c9cfd0,
                    #c5ccc9,
                    #c5c8c0);
            margin-left: auto;
            margin-right: auto;">

        <a href=""></a>
        <a href=""></a>
        <a href=""></a>
    </nav>

    <div style=" width: 960px;
            height: 150px;
            background: white;
            display: flex;
            align-content: space-between;
            margin-left: auto;
            margin-right: auto;" class="header">
        <div style="  width: 150px;
            border-right: solid grey 2px;" class="logo1">
            <img src="https://i.ibb.co/bBkyW9q/ic-school-128-28729.png"
                 alt="logo2" width="128" height="150">
        </div>
        <div class="titulo">
            <h1 style="  width: 660px;
            height: 150px;
            text-align: center;
            font-size: 3.5em;
            font-family: Arial, Helvetica, sans-serif;">Centro Educacional
                Espaço Educar
            </h1>

        </div>

        <div style=" width: 150px;
            border-left: solid grey 2px;" class="logo2">
            <img src="https://i.ibb.co/ykDZ8My/1490886282-18-school-building-82486.png"
                 alt="logo1" alt="logo1" width="128" height="150">
        </div>
    </div>

</header>
<div style="     position: relative;
            width: 960px;
            height: 520px;
            margin-left: auto;
            margin-right: auto;
            text-align: justify;
            font-family: cursive;
            background-color: ghostwhite;
            font-size: 1.2em;" class="content">
    <H1 style="  padding-top: 50px;" align="center">Solicitação de troca de
        senha</H1>
    <p style="  padding: 25px 120px;
              text-align: justify;">Caro usuário(a) <?
    = $usuario->getEmail();?>,
        foi solicitado a troca se sua senha em
        nosso
        sistema,
        se vc solicitou a recuperação da sua
        senha acesse o link abaixo:</p>

    <form action="http://localhost/valida-senha" method="post">
        <input name="email" value="<?
        = $usuario->getEmail();?>" type="hidden">
        <button style=" margin-left: 120px; border: none;font-family: Arial;background: none;font-size: 0.8em;text-decoration: underline;color: dodgerblue; cursor: pointer;"
                type="submit">Clique aqui
        </button>

    </form>
    <p style="  padding: 25px 120px;
            text-align: justify;"> A equipe Espaço Educar orienta que nenhum
        e-mail, SMS, ou ligação é
        realizado aos nosso clientes pedindo informações a respeito de sua
        senha.
        Para mais informações entre em contato conosco</p>
</div>
<div style="    position: relative;

            width: 960px;
            height: 130px;
            margin-left: auto;
            margin-right: auto;" class="footer">
    <img src="https://i.ibb.co/dML6YXK/banner-contato1.jpg" alt="contato"
         width="960" height="130">
</div>
<p style=" text-align: center;
            width: 960px;
            height: 60px;
            background-color: grey;
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: auto;
            margin-right: auto;
            padding-top: 60px;" class="footerCop"> ©Ronycode. Todos os direitos
    reservados</p>
