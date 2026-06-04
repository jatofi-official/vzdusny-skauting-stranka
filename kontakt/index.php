<?php
if (file_exists('../db.php')) {
    require_once '../db.php';
}
$page_title = "Kontakt - Vzdušný Skauting";
$custom_css = ['/kontakt/kontakt.css'];
include '../header.php';
include '../navigation.php';
?>

<div class="kontakt-container">
    <h1 style="text-align: center; color: var(--slsk-dark-blue); margin-top: 20px; text-transform: uppercase; font-weight: 800; font-size: 2.5rem;">Náš Tím</h1>

    <!-- Grid s profilmi -->
    <div class="team-grid">
        
        <div class="team-card">
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect width='150' height='150' fill='%23e0e0e0'/%3E%3Cpath d='M75 75c13.26 0 24-10.74 24-24s-10.74-24-24-24-24 10.74-24 24 10.74 24 24 24zm0 12c-16.02 0-48 8.04-48 24v15h96v-15c0-15.96-31.98-24-48-24z' fill='%23a0a0a0'/%3E%3C/svg%3E" alt="Profilová fotka" class="profile-img rover">
            <h3 class="name">Išmael</h3>
            <p class="role">Zakladateľ</p>

            <div class="contact-info">
                <a href="https://discord.com/users/781569764131733555">Discord</a>
            </div>
        </div>
        
        <div class="team-card">
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect width='150' height='150' fill='%23e0e0e0'/%3E%3Cpath d='M75 75c13.26 0 24-10.74 24-24s-10.74-24-24-24-24 10.74-24 24 10.74 24 24 24zm0 12c-16.02 0-48 8.04-48 24v15h96v-15c0-15.96-31.98-24-48-24z' fill='%23a0a0a0'/%3E%3C/svg%3E" alt="Profilová fotka" class="profile-img rover">
            <h3 class="name">Jakoo</h3>
            <p class="role">Vedúci programovej rady<br>Komunikácia</p>

            <div class="contact-info">
                <a href="mailto:email1@skauting.sk">jakubo.hlavaty@gmail.com</a>
                <a href="https://discord.com/users/622362092686802954">Discord</a>

            </div>
        </div>

        <div class="team-card">
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect width='150' height='150' fill='%23e0e0e0'/%3E%3Cpath d='M75 75c13.26 0 24-10.74 24-24s-10.74-24-24-24-24 10.74-24 24 10.74 24 24 24zm0 12c-16.02 0-48 8.04-48 24v15h96v-15c0-15.96-31.98-24-48-24z' fill='%23a0a0a0'/%3E%3C/svg%3E" alt="Profilová fotka" class="profile-img ranger">
            <h3 class="name">Mapi</h3>
            <p class="role">Člen programovej rady<br>Vedúci projektu <a href="https://minecraft.mustangy.sk/">MustangSMP</a></p>

            <div class="contact-info">
                <a href="https://discord.com/users/789445168230170634">Discord</a>
            </div>
        </div>
        
        <div class="team-card">
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect width='150' height='150' fill='%23e0e0e0'/%3E%3Cpath d='M75 75c13.26 0 24-10.74 24-24s-10.74-24-24-24-24 10.74-24 24 10.74 24 24 24zm0 12c-16.02 0-48 8.04-48 24v15h96v-15c0-15.96-31.98-24-48-24z' fill='%23a0a0a0'/%3E%3C/svg%3E" alt="Profilová fotka" class="profile-img rover">
            <h3 class="name">Luke</h3>
            <p class="role">Člen programovej rady</p>
        </div>

        <div class="team-card">
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect width='150' height='150' fill='%23e0e0e0'/%3E%3Cpath d='M75 75c13.26 0 24-10.74 24-24s-10.74-24-24-24-24 10.74-24 24 10.74 24 24 24zm0 12c-16.02 0-48 8.04-48 24v15h96v-15c0-15.96-31.98-24-48-24z' fill='%23a0a0a0'/%3E%3C/svg%3E" alt="Profilová fotka" class="profile-img ranger">
            <h3 class="name">Brutto</h3>
            <p class="role">Člen programovej rady</p>
        </div>
        
    </div>

</div>

<section class="about-section">
    <div class="about-grid">
        <div>
            <p>Ak máš nejaké otázky, neváhaj a ozvi sa nám!</p>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>