<x-guest-layout>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #FFFAEC;
    }

    /* ❗ DO NOT OVERRIDE guest-layout alignment classes anymore */

    .wrapper {
        width: 100%;
        max-width: 1100px;
        margin: auto;
        padding: 140px 20px 100px; /* FIX: pushes content below navbar */
    }

    /* HEADER */
    .header {
        background: linear-gradient(135deg, #1E3A8A 0%, #1e40af 100%);
        color: white;
        padding: 60px 30px;
        text-align: center;
        border-radius: 40px;
        box-shadow: 0 20px 40px rgba(30, 58, 138, 0.15);
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    .header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(246, 199, 111, 0.1);
        border-radius: 50%;
        filter: blur(80px);
    }

    .header h1 {
        margin: 0;
        font-size: 3rem;
        font-weight: 800;
        letter-spacing: -2px;
    }

    .header span { color: #f6c76f; }

    .header p {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 14px;
        opacity: 0.8;
        margin-top: 10px;
    }

    /* GRID */
    .container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    /* CARD */
    .card {
        background: white;
        border-radius: 32px;
        padding: 40px;
        text-align: center;
        border: 1px solid rgba(30, 58, 138, 0.05);
        box-shadow: 0 15px 35px rgba(120, 53, 15, 0.05);
        transition: all 0.4s ease;
    }

    .card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px rgba(30, 58, 138, 0.1);
        border-color: #f6c76f;
    }

    /* 2x2 IMAGE STYLE */
    .avatar-img {
        width: 2in;
        height: 2in;
        object-fit: cover;
        border-radius: 0;
        margin: 0 auto 25px;
        display: block;
        box-shadow: 0 10px 20px rgba(30, 58, 138, 0.2);
        border: 3px solid #f6c76f;
    }

    .name {
        font-weight: 800;
        font-size: 22px;
        color: #1E3A8A;
        margin-bottom: 5px;
    }

    .role {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        color: #f59e0b;
        letter-spacing: 1px;
        margin-bottom: 20px;
        display: inline-block;
        padding: 4px 12px;
        background: #fffbeb;
        border-radius: 8px;
    }

    .motto {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
        font-weight: 500;
        font-style: italic;
        padding-bottom: 5px;
    }
    .desc {
        font-size: 15px;
        color: #525252;
        line-height: 1.6;
        font-weight: 500;
    }

    .social-links {
        margin-top: 25px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-links a {
        color: #cbd5e1;
        font-size: 18px;
        transition: 0.3s;
    }

    .social-links a:hover {
        color: #1E3A8A;
    }
</style>

<div class="wrapper">

    <div class="header">
        <h1>LGMED <span>Compass</span></h1>
        <p>Developers</p>
    </div>

    <div class="container">

        <!-- Valleree -->
        <div class="card">
            <img class="avatar-img"
                src="https://www.image2url.com/r2/default/images/1776677156989-f9ba087a-13b1-4052-b098-090b23b03bc8.png"
                alt="Valleree Joseph">

            <div class="name">Valleree Joseph</div>
            <div class="motto">
                "Try and Try until you die"
            </div>
            <div class="role">Full Stack Developer</div>
            <!--<div class="desc">Assisted in the development and integration of the calendar feature, implemented account/profile management functionality, and contributed to the merging and consolidation of code to ensure system consistency and improved overall application stability.</div>-->

            <div class="social-links">
                <a href="https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.linkedin.com%2Fin%2Fvalleree-joseph-765470193%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExeXdFbmgzb1dxS01XRmRRUXNydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR7VdoXwoWSizj6LWR79RhIa9BTfw4U7ia1UZ9tEOQ6JB2sB2L6YUT3CBzgaNg_aem_PMQUkcaVyNJyh4V3AXswMw&h=AT7je5uwhe8DT6kKx_UA2zJ5X2Xt4CP0rjFo91G0dNXH2zjgDGlVXPAFRDvYuX8yW-LeNakZyhHYFAaFUiy5po_x1JQZybhvj-yCbdapOb5g-jb2wUwyLIeLn-3SIoU" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=vallereejoseph@gmail.com" target="_blank"><i class="bi bi-envelope"></i></a>
            </div>
        </div>

        <!-- Ebram -->
        <div class="card">
            <img class="avatar-img"
                src="https://i.ibb.co/whQtBwvp/672165252-1901433497229898-5083119935872956535-n.jpg"
                alt="Ebram Barlam">

            <div class="name">Ebram Barlam</div>
            <div class="motto">
                "Life is like a game—sometimes you win, sometimes you lose."
            </div>
            <div class="role">Full Stack Developer</div>
            <!--<div class="desc">Assisted in the development and enhancement of the document management system, including process flow implementation and archiving functionality to ensure organized storage, efficient retrieval, and improved document handling within the system.</div>-->

            <div class="social-links">
                <a href="https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.linkedin.com%2Fin%2Febram-barlam-a30bb6381%3Ffbclid%3DIwZXh0bgNhZW0CMTAAYnJpZBExeXdFbmgzb1dxS01XRmRRUXNydGMGYXBwX2lkEDIyMjAzOTE3ODgyMDA4OTIAAR7No6_cr5OSU5lrDhCSJSw97VROqvHwC8cOjkKqYqeJsRopzlpy3hh86yB62Q_aem_c3WYfzpZCdLkxPj6pwWJzg&h=AT43mWQmqVoMXFsKzN_6AQijvwazBwSdB-Z8WMbfJOCi7tqJkIkszJOo2B7d8Fw9GU7yyi9FOnO4H7Bt3iufay3Bxdg7pg4Apz8vGXgyhdvyNVxrc2if3iipt7CRHKQ" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ebrambarlam87@gmail.com" target="_blank"><i class="bi bi-envelope"></i></a>
            </div>
        </div>

        <!-- Ysabel -->
        <div class="card">
            <img class="avatar-img"
                src="https://www.image2url.com/r2/default/images/1776677240452-0f5643bb-c7d6-4377-b737-5c6518798c81.png"
                alt="Ysabel Mendoza">

            <div class="name">Ysabel Dominique Mendoza</div>
            <div class="motto">
                "Keep Moving Forward"
            </div>
            <div class="role">UI/UX Designer</div>
            <!--<div class="desc">Designed and developed the user interface of the landing page, and assisted in structuring the organization and PPA (Programs, Projects, and Activities) sections to improve presentation, usability, and overall system navigation.</div>-->

            <div class="social-links">
                <a href="https://www.linkedin.com/in/ysabel-mendoza-98bba8310" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ysabelmendoza525@gmail.com" target="_blank"><i class="bi bi-envelope"></i></a>
            </div>
        </div>


    </div>
</div>

</x-guest-layout>