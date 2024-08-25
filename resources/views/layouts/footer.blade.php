<style>
.footer-custom {
    background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(40,167,69,1) 100%);
    color: white;
    padding: 20px 0;
    text-align: center;
}
.footer-custom {
    background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(40,167,69,1) 100%);
    color: white;
    padding: 40px 0;
}
.footer-custom .footer-logo {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
.footer-custom .footer-logo img {
    height: 40px;
    margin-right: 15px;
}
.footer-custom .footer-social-icons a {
    color: white;
    margin-right: 15px;
    font-size: 20px;
    transition: color 0.3s;
}
.footer-custom .footer-social-icons a:hover {
    color: rgba(255, 255, 255, 0.7);
}
.footer-custom .footer-links a {
    color: white;
    transition: color 0.3s;
}
.footer-custom .footer-links a:hover {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
}
.footer-custom .footer-text {
    margin-top: 20px;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
}
</style>

 <!-- Footer -->
 <footer class="footer-custom">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-logo">
                <x-application-logo alt="Company Logo" class="logo" />
                <span class="h5 mb-0">MadinTechnologies</span>
            </div>
            <div class="col-md-4 footer-social-icons text-center">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-dribbble"></i></a>
                <a href="#"><i class="fa fa-behance"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
            <div class="col-md-4 footer-links text-right">
                <a href="#">Privacy Policy</a><br>
                <a href="#">Terms of Use</a><br>
                <a href="#">Contact Us</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center footer-text">
                © 2023 MadinTechnologies. All Rights Reserved.
            </div>
        </div>
    </div>
</footer>