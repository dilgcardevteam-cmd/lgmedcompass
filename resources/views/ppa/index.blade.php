<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/plus-jakarta-sans.css') }}">
<style>
    :root {
        --primary: #f59e0b;
        --primary-soft: #fffbeb;
        --border-warm: #fef3c7;
        --border: #f6c76f;
        --card-shadow: 0 10px 25px rgba(120, 53, 15, 0.05);
        --text-main: #2D241E;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #fefce8;
        color: var(--text-main);
    }

    .container {
        max-width: 1300px;
        margin: auto;
        padding: 30px 20px;
        border-radius: 24px;
        border: 2px solid var(--border);
        box-shadow: var(--card-shadow);
        background: white;
    }

    .title {
        text-align: center;
        margin-bottom: 40px;
    }

    .title h1 {
        font-size: 36px;
        font-weight: 800;
        color: #000000;
        margin-bottom: 8px;
    }

    .title p {
        background: linear-gradient(135deg, #646464, #646464);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1rem;
        font-weight: 500;
        max-width: 900px;
        margin: auto;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .card {
        background: #fff;
        border: 2px solid var(--border-warm);
        border-radius: 20px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: block;
        color: inherit;
        max-width: 320px;
        margin: 0 auto;
        width: 100%;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px rgba(120, 53, 15, 0.1);
        border-color: var(--primary);
    }

    .card-top {
        background:#FFC93C;
        padding: 40px;
        text-align: center;
    }

    .card-top img {
        width: 100px;
        display: block;
        margin: 0 auto;
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-code {
        font-size: 13px;
        font-weight: 800;
        color: #C42021;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .card-name {
        font-size: 16px;
        font-weight: 700;
        margin-top: 10px;
        line-height: 1.4;
        
    }
</style>

<div class="container">
    <div class="title">
        <h1>Programs, Projects & Activities</h1>
        <p>Select Section to view PPAs</p>
    </div>
    <div class="grid">
        @foreach($sections as $section)
            <a href="{{ route('ppa.section', $section->code) }}" class="card">
                <div class="card-top">
                    <img src="{{ asset('images/dilg-logo.png') }}" alt="DILG Logo">
                </div>
                <div class="card-body">
                    <div class="card-code">{{ strtoupper($section->code) }}</div>
                    <div class="card-name">{{ $section->name }}</div>
                </div>
            </a>
        @endforeach
    </div>
</div>
</x-app-layout>