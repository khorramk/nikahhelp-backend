<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Email</title>
    <style type="text/css">
        body {
            margin: 0;
        }
        h2 {
            font-size: 15px;
        }
        p {
            font-size: 13px;
        }
        .center {
            text-align: center;
        }
        .mx-auto {
            margin: 0 auto;
        }
        .w-full {
            width: 100%;
        }
        .primary-text {
            color: #522e8e;
        }
        .font-italic {
            font-style: italic;
        }
        .font-weight-bold {
            font-weight: bold;
        }
        .text-black {
            color: #000000;
            opacity: 0.75;
        }
        .mt-5 {
            margin-top: 20px;
        }
        .mt-8 {
            margin-top: 32px;
        }
        .content-div {
            width: 300px;
        }
        .header {
            background: #522e8e;
            display: flex;
            justify-content: center;
        }
        .mat-logo {
            width: 170px;
            height: 110px;
        }
        .title-text {
            color: rgb(96 84 84 / 85%);
        }
        .link-text {
            color: #1d68a7;
        }
        .verify-btn {
            padding: 12px 30px;
            border-radius: 30px;
            background: #522e8e;
            border: 3px solid #FFFFFF;
            cursor: pointer;
            color: #FFFFFF;
            font-size: 20px;
            text-align: center;
            display: inline-block;
            margin: 0 auto;
            font-weight: bold;
            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -ms-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }
        .verify-btn:hover {
            background: #FFFFFF;
            border: 3px solid #522e8e;
            color: #522e8e;
        }
        @media (min-width: 520px) {
            .content-div {
                width: 500px;
            }
            h2 {
                font-size: 24px;
            }
            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body style="margin: 0;">
<div style="background: #522e8e; display: flex; justify-content: center;">
    <a><img src="{{ asset('https://chobi.arranzed.com/image/site/ma_logo_white.svg') }}" alt="logo" style="width: 170px; height: 110px;" /></a>
</div>

<div style="color: rgb(96 84 84 / 85%); margin: 0 auto; width: 500px;">
    @php
        $domain=env('WEB_DOMAIN');
    @endphp
    <div style="width: 100%; margin-top: 30px;">
        <h2 style="font-size: 28px; color: rgba(0,0,0,.5); text-align: center">Subscription payment</h2>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">{{ @$subscription->user->full_name }},</p>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            Thank you for using MatrimonyAssist [{{ date('d M Y h:i A') }}]
        </p>

        <p style="font-size: 22px; color: rgba(3,3,3,0.73); margin-top: 28px; text-align: center">
            Here's what you have paid for
        </p>

        <table style="width: 100%; border-collapse: collapse; border-spacing: 20px; font-weight: bold">
            <tr style="border-bottom: 1px solid black; height: 40px">
                <td>Items</td>
                <td style="text-align: right">Cost</td>
            </tr>
            <tr style="height: 30px">
                <td>{{ @$subscription->plans->title }} subscription plan for - {{ @$team->name }}</td>
                <td style="text-align: right">£ {{ @$subscription->plans->price }}</td>
            </tr>
        </table>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px; font-weight: bold">
            Any member of a team can pay on behalf of a team they belong to.
        </p>

        <div style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            Details:
        </div>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            {{ @$subscription->plans->title }} subscription plan for - <span style="color: #522e8e;"> {{ @$team->name }} </span> <br>
            Subscription expire date extended to: {{ Carbon::parse($team->subscription_expire_at)->format('d M Y') }}
        </p>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            The owner of this team is <span style="color: #522e8e;"> {{ @$team->created_by->full_name }} </span>.
        </p>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            Card payment details:
        </p>

        <table style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            <tr>
                <td>Card type</td>
                <td style="padding-left: 20px">:</td>
                <td style="padding-left: 20px"> N/A </td>
            </tr>
            <tr>
                <td>Payment total</td>
                <td style="padding-left: 20px">:</td>
                <td style="padding-left: 20px">£{{ @$subscription->plans->price }}</td>
            </tr>
            <tr>
                <td>Reference</td>
                <td style="padding-left: 20px">:</td>
                <td style="padding-left: 20px">{{ @$subscription->stripe_id }}</td>
            </tr>
            <tr>
                <td>Transaction date/time</td>
                <td style="padding-left: 20px">:</td>
                <td style="padding-left: 20px">{{ Carbon::parse($subscription->created_at)->format('d M Y h:i:s A') }}</td>
            </tr>
            <tr>
                <td>Payer details</td>
                <td style="padding-left: 20px">:</td>
                <td style="padding-left: 20px">{{ @$subscription->user->full_name }}</td>
            </tr>
            <tr>
                <td>Order reference</td>
                <td style="padding-left: 20px">:</td>
                <td style="padding-left: 20px">{{ $subscription->id }}</td>
            </tr>
        </table>

        <div style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            Help and guidance on how to subscribe and subscription detail. <a href="">http://www.nikah.arranzed.com/help</a>
        </div>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 28px;">
            Please note this is an automated email. Please do not reply as the email will not reach MatrimonyAssist Team
        </p>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 32px">
            Thanks, <br>
            Regards <br>
            Matrimony Assist Team
        </p>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 32px; text-align: center;">
            This email was sent to <span style="color: #522e8e;">{{ @$subscription->user->email }}</span>, which is
            associated with a Matrimony Assist account.
        </p>

        <p style="font-size: 16px; color: rgba(0,0,0,.5); margin-top: 20px; text-align: center;">
            &copy; 2022 Matrimony Assist Inc., All Rights Reserved Matrimony Assist Inc., 55 2nd Street London, UK 94105
        </p>
    </div>
</div>
</body>
</html>