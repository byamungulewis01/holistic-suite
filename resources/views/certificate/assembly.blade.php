<!DOCTYPE html>
<html>

<head>
    <title>{{ $record->document_no }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ public_path('img/logo.jpeg') }}" />
    <style>
        body {
            font-family: Algeria;
            font-size: 18px;
            margin: 0%;
            padding: 0%;
        }

        .couple-info ul {
            list-style-type: none;
            padding: 0;
        }

        .couple-info li {
            margin-bottom: 10px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <header style="margin-bottom: 10px;">
        <table style="width: 100%; height:10px;">
            <tr>
                <td width="120px;" style="border-right: 2px solid #a6a6a6;">
                    <img src="{{ public_path('img/logo.jpeg') }}" alt="Logo" width="80" height="80">
                </td>
                <td>
                    <div style="margin-left: 20px">
                        <h2 style="margin-top:0%; margin-bottom:1px;letter-spacing: 2px; font-family: Brush Script MT;">
                            <i>Eglise
                                de Pentecôte du Rwanda </i>
                        </h2>
                        <h5 style="margin: 0%;">URUREMBO RWA {{ strtoupper($ururembo->name) }}</h5>
                        <h5 style="margin: 0%;">PARUWASE : {{ strtoupper($paruwase->name) }}</h5>
                        <h5 style="margin: 0%;">TEL : {{ (!$paruwase->phone) ? '..........................' :
                            $paruwase->phone }}</h5>
                        <h5 style="margin: 0%;">E-mail : {{ (!$paruwase->email) ? '..........................' :
                            $paruwase->email }}</h5>
                    </div>
                </td>
            </tr>
        </table>
    </header>
    <div style="margin-bottom: 12px;">
        <div style="width: 100%; background-color:rgb(148, 207, 244);height:10px;"></div>
        <div style="width: 100%; background-color:rgb(255, 255, 255);height:4px;"></div>
        <div style="width: 100%; background-color:rgba(219, 77, 0, 0.822);height:4px;"></div>
    </div>
    <div style="width: 100%; background-color:rgb(219, 219, 219);height:2px;"></div>
    <h2 style="margin-top: 1%;margin-bottom: 1%;letter-spacing: 3px;">
        ICYEMEZO CYO GUTERANA
    </h2>
    <div style="width: 100%; background-color:rgb(219, 219, 219);height:2px;"></div>
    <main style="margin-bottom: 0px;">
        <section class="couple-info">
            <ul>
                <li><strong>Amazina: </strong>{{ $member->name }}</li>
                <li><strong>Numbero: </strong>{{ (!$member->phone) ? "......................" : $member->phone }}</li>
            </ul>
    </main>
    <div style="width: 100%; background-color:rgb(219, 219, 219);height:2px;"></div>
    <p style="line-height: 1.5;">Twabwe <strong>{{ (!$parish_paster) ? '..........................................' : $parish_paster->name }}</strong> Umushumba wa ADEPR Paruwase ya {{
        $paruwase->name }},
        Dushingiye ku buhamya bw'Umuyobozi wa ADEPR Itorero rya <b>{{ $itorero->name }}</b> turemeza ko uyu
        {{ ($member->gender == 1) ? 'mwenedata' : 'mushikiwacu' }} <strong>{{ $member->name }} </strong>
        amaze igihe ateranira ku Itorero rya <b>{{ $itorero->name }}</b> Paruwase ya <b>{{ $paruwase->name }}</b>
        Akaba Agiye mu Itorero rya <b>{{ $member->localChurch->name }}</b> Paruwase ya <b>{{ $member->parish->name
            }}</b> Urerembo rwa <b>{{ $member->region->name }}</b>.
    </p>
    <p> Itariki Icyangobwa gitangiwe : {{ \Carbon\Carbon::parse($record->aproovedDate)->format('d/m/Y') }}</b>
    </p>
    <p>Itariki Icyangobwa Kizamara : {{ \Carbon\Carbon::parse($record->aproovedDate)->addDays(10)->format('d/m/Y')
        }}</b>
    </p>
    <p>Bikorewe i <strong>{{ $paruwase->name }}</strong> kuwa <b>{{
            \Carbon\Carbon::parse($record->aproovedDate)->format('d/m/Y') }}</b></p>
    <div style="width: 100%; background-color:rgb(219, 219, 219);height:2px;"></div>


    <table style="width: 100%;">
        <tr>
            <td>
                <p style="margin-bottom: 1%;margin-top: 1%;"> Umuyobozi w'Itorero rya <strong>{{ $itorero->name
                        }}</strong></p>
                <p style="margin-bottom: 1%;margin-top: 1%;"> Amazina : <strong>{{ $paster->name }}</strong></p>
                <p style="margin-bottom: 1%;margin-top: 1%;"> Telefone :<strong>{{ (!$itorero->phone) ?
                        '..........................' : $itorero->phone }}</strong></p>
                <p style="margin-bottom: 1%;margin-top: 1%;"> E-mail :<strong>{{ (!$itorero->email) ?
                        '..........................' : $itorero->email }}</strong></p>
            </td>
            <td>
                <p style="margin-bottom: 1%;margin-top: 1%;"> Umuyobozi wa Paruwase ya <strong>{{ $paruwase->name
                        }}</strong></p>
                <p style="margin-bottom: 1%;margin-top: 1%;"> Amazina : <strong>{{ (!$parish_paster) ? '............................' : $parish_paster->name }}</strong></p>
                <p style="margin-bottom: 1%;margin-top: 1%;"> Telefone :<strong>{{ (!$paruwase->phone) ?
                        '..........................' : $paruwase->phone }}</strong></p>
                <p style="margin-bottom: 1%;margin-top: 1%;"> E-mail :<strong>{{ (!$paruwase->email) ?
                        '..........................' : $paruwase->email }}</strong></p>
            </td>
        </tr>
    </table>
    <div style="width: 100%; background-color:rgb(219, 219, 219);height:2px;margin-top: 1%;margin-bottom: 1%;"></div>
    <br>
    <table style="width: 100%;">
        <tr>
            <td width="150px;">
                <img src="{{ public_path('img/qrcode.jpg') }}" alt="Logo" width="140" height="160">
            </td>
            <td>

                <strong>
                    Sikana iyo code Mukugenzura iyi nyandiko
                </strong>
                <br>
                CYANGWA Ugenzure kuri AMS ukoresheje numero y'Icyemezo
                <br> <strong>{{ $record->document_no }}</strong>
                <br>


            </td>
        </tr>
    </table>

    <br>
    <div style="width: 100%; background-color:rgb(219, 219, 219);height:2px;margin-top: 1%;margin-bottom: 1%;"></div>
    <table style="width: 100%;">
        <tr>
            <td>
                B.P.404 Kigali - Rwanda <br>
                E-mail : info@adepr.org <br>
                Website : www.adepr.rw <br>
            </td>
            <td>
                Arrêtê Rayal du 30 septambre 1930 <br>
                Arrêtê Ministériel no 485/08 du 19 Octobre 1962 <br>
                Arrêtê Ministériel no 03/7 du 6 janvier 1984 <br>
            </td>
        </tr>
    </table>

</body>

</html>
