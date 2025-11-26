document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('truck-container');
    if (!container) return;

    // Scene setup
    const scene = new THREE.Scene();
    scene.background = null; // Transparent background to blend with site

    // Camera setup
    const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(5, 3, 5);
    camera.lookAt(0, 0, 0);

    // Renderer setup
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);

    // Controls
    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.enableZoom = false;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 2.0;

    // Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1.0);
    directionalLight.position.set(5, 10, 7);
    directionalLight.castShadow = true;
    scene.add(directionalLight);

    const pointLight = new THREE.PointLight(0xff9000, 0.5); // Warm light for accent
    pointLight.position.set(-5, 2, -5);
    scene.add(pointLight);

    // --- Truck Construction ---
    const truckGroup = new THREE.Group();

    // Materials
    const cabinMaterial = new THREE.MeshStandardMaterial({
        color: 0xdc2626, // Red
        roughness: 0.3,
        metalness: 0.7
    });

    const trailerMaterial = new THREE.MeshStandardMaterial({
        color: 0xe5e5e5, // White/Light Grey
        roughness: 0.2,
        metalness: 0.1
    });

    const chassisMaterial = new THREE.MeshStandardMaterial({
        color: 0x171717, // Dark Grey/Black
        roughness: 0.8,
        metalness: 0.5
    });

    const glassMaterial = new THREE.MeshStandardMaterial({
        color: 0x1e293b,
        roughness: 0.1,
        metalness: 0.9,
        transparent: true,
        opacity: 0.7
    });

    const wheelMaterial = new THREE.MeshStandardMaterial({
        color: 0x111111,
        roughness: 0.9
    });

    const rimMaterial = new THREE.MeshStandardMaterial({
        color: 0xcccccc,
        metalness: 0.8,
        roughness: 0.2
    });

    // 1. Chassis (Base)
    const chassisGeo = new THREE.BoxGeometry(1.8, 0.2, 4.5);
    const chassis = new THREE.Mesh(chassisGeo, chassisMaterial);
    chassis.position.y = 0.4;
    chassis.castShadow = true;
    truckGroup.add(chassis);

    // 2. Cabin (Front)
    const cabinGroup = new THREE.Group();

    // Main cabin body
    const cabinBodyGeo = new THREE.BoxGeometry(1.8, 1.5, 1.2);
    const cabinBody = new THREE.Mesh(cabinBodyGeo, cabinMaterial);
    cabinBody.position.set(0, 1.25, 1.5);
    cabinBody.castShadow = true;
    cabinGroup.add(cabinBody);

    // Windshield
    const windshieldGeo = new THREE.BoxGeometry(1.6, 0.6, 0.1);
    const windshield = new THREE.Mesh(windshieldGeo, glassMaterial);
    windshield.position.set(0, 1.6, 2.11); // Slightly in front
    cabinGroup.add(windshield);

    // Side windows
    const sideWindowGeo = new THREE.BoxGeometry(1.82, 0.5, 0.6);
    const sideWindow = new THREE.Mesh(sideWindowGeo, glassMaterial);
    sideWindow.position.set(0, 1.6, 1.5);
    cabinGroup.add(sideWindow);

    truckGroup.add(cabinGroup);

    // 3. Cargo Box (Rear)
    const cargoGeo = new THREE.BoxGeometry(1.9, 1.8, 3.2);
    const cargo = new THREE.Mesh(cargoGeo, cabinMaterial); // Making it red to match the "red truck" request
    cargo.position.set(0, 1.4, -0.8);
    cargo.castShadow = true;
    truckGroup.add(cargo);

    // Add some details to cargo
    const cargoDetailGeo = new THREE.BoxGeometry(1.95, 1.85, 0.1);
    const cargoDetail = new THREE.Mesh(cargoDetailGeo, trailerMaterial); // Contrast strip
    cargoDetail.position.set(0, 1.4, -2.41);
    truckGroup.add(cargoDetail);

    // 4. Wheels
    function createWheel(x, z) {
        const wheelGroup = new THREE.Group();

        // Tire
        const tireGeo = new THREE.CylinderGeometry(0.35, 0.35, 0.25, 32);
        tireGeo.rotateZ(Math.PI / 2);
        const tire = new THREE.Mesh(tireGeo, wheelMaterial);
        tire.castShadow = true;
        wheelGroup.add(tire);

        // Rim
        const rimGeo = new THREE.CylinderGeometry(0.2, 0.2, 0.26, 16);
        rimGeo.rotateZ(Math.PI / 2);
        const rim = new THREE.Mesh(rimGeo, rimMaterial);
        wheelGroup.add(rim);

        wheelGroup.position.set(x, 0.35, z);
        return wheelGroup;
    }

    // Front wheels
    truckGroup.add(createWheel(0.9, 1.5));
    truckGroup.add(createWheel(-0.9, 1.5));

    // Rear wheels (Double axle)
    truckGroup.add(createWheel(0.9, -1.2));
    truckGroup.add(createWheel(-0.9, -1.2));
    truckGroup.add(createWheel(0.9, -2.0));
    truckGroup.add(createWheel(-0.9, -2.0));

    // Add truck to scene
    scene.add(truckGroup);

    // Ground shadow (fake shadow plane)
    const shadowGeo = new THREE.PlaneGeometry(3.5, 6);
    const shadowMat = new THREE.MeshBasicMaterial({
        color: 0x000000,
        transparent: true,
        opacity: 0.3
    });
    const shadowPlane = new THREE.Mesh(shadowGeo, shadowMat);
    shadowPlane.rotation.x = -Math.PI / 2;
    shadowPlane.position.y = 0.05;
    scene.add(shadowPlane);

    // Animation Loop
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }
    animate();

    // Handle Resize
    window.addEventListener('resize', function () {
        if (!container) return;
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    });
});
