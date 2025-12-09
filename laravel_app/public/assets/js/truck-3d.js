document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('truck-container');
    if (!container) return;

    // Scene setup
    const scene = new THREE.Scene();
    scene.background = null;

    // Camera setup
    const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(6, 4, 6);
    camera.lookAt(0, 1, 0);

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

    // Lighting - Enhanced for "Cyber/Premium" look
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    const dirLight = new THREE.DirectionalLight(0xffffff, 1.0);
    dirLight.position.set(5, 10, 7);
    dirLight.castShadow = true;
    scene.add(dirLight);

    // Purple Glow Light (to match brand)
    const purpleLight = new THREE.PointLight(0xa78bfa, 2.0, 10); // Lighter Violet from image
    purpleLight.position.set(-2, 3, 2);
    scene.add(purpleLight);

    // --- Truck Construction ---
    const truckGroup = new THREE.Group();

    // Materials - Synced with UI (Dark Mode + Purple Accents)
    // Using MeshToonMaterial for the stylized look, but with premium colors

    const outlineMaterial = new THREE.LineBasicMaterial({ color: 0x000000, linewidth: 2 });

    // Truck Body: Dark Grey (Charcoal) to match the dark theme
    const bodyMat = new THREE.MeshToonMaterial({ color: 0x1f2937 }); // Gray-800

    // Cabin: Slightly lighter Dark Grey for depth
    const cabinMat = new THREE.MeshToonMaterial({ color: 0x374151 }); // Gray-700

    // Details: Black/Very Dark Grey
    const darkMat = new THREE.MeshToonMaterial({ color: 0x111827 });

    // Windows: Dark Tinted Glass (Almost black with blue reflection)
    const windowMat = new THREE.MeshToonMaterial({ color: 0x0f172a, opacity: 0.9, transparent: true });

    // Wheels: Black
    const wheelMat = new THREE.MeshToonMaterial({ color: 0x000000 });

    // Rims: Dark Grey metallic look
    const rimMat = new THREE.MeshToonMaterial({ color: 0x4b5563 });

    // Cargo Materials - Brand Gradient Colors
    const boxPurpleMat = new THREE.MeshToonMaterial({ color: 0xa78bfa }); // Lighter Violet from image
    const boxDarkPurpleMat = new THREE.MeshToonMaterial({ color: 0x6d28d9 }); // Darker Purple
    const boxTealMat = new THREE.MeshToonMaterial({ color: 0x14b8a6 }); // Teal Accent (Complementary)

    // Helper to add outlines
    function addOutline(mesh, geometry) {
        const edges = new THREE.EdgesGeometry(geometry);
        const line = new THREE.LineSegments(edges, outlineMaterial);
        mesh.add(line);
    }

    // 1. Truck Body (Rear Box)
    const bodyGeo = new THREE.BoxGeometry(2.5, 1.5, 1.4);
    const body = new THREE.Mesh(bodyGeo, bodyMat);
    body.position.set(-0.5, 1.1, 0);
    body.castShadow = true;
    addOutline(body, bodyGeo);
    truckGroup.add(body);

    // Stripe on body (Brand Purple)
    const stripeGeo = new THREE.BoxGeometry(2.52, 0.2, 1.42);
    const stripe = new THREE.Mesh(stripeGeo, boxPurpleMat);
    stripe.position.set(-0.5, 0.8, 0);
    truckGroup.add(stripe);

    // 2. Cabin (Front)
    const cabinGeo = new THREE.BoxGeometry(1.0, 1.2, 1.4);
    const cabin = new THREE.Mesh(cabinGeo, cabinMat);
    cabin.position.set(1.25, 0.95, 0);
    cabin.castShadow = true;
    addOutline(cabin, cabinGeo);
    truckGroup.add(cabin);

    // Hood/Nose
    const hoodGeo = new THREE.BoxGeometry(0.5, 0.7, 1.4);
    const hood = new THREE.Mesh(hoodGeo, cabinMat);
    hood.position.set(2.0, 0.7, 0);
    hood.castShadow = true;
    addOutline(hood, hoodGeo);
    truckGroup.add(hood);

    // Windows
    const windshieldGeo = new THREE.PlaneGeometry(0.8, 0.5);
    const windshield = new THREE.Mesh(windshieldGeo, windowMat);
    windshield.position.set(1.76, 1.2, 0);
    windshield.rotation.y = Math.PI / 2;
    truckGroup.add(windshield);

    const sideWindowGeo = new THREE.PlaneGeometry(0.5, 0.5);
    const sideWindowLeft = new THREE.Mesh(sideWindowGeo, windowMat);
    sideWindowLeft.position.set(1.25, 1.2, 0.71);
    truckGroup.add(sideWindowLeft);

    const sideWindowRight = new THREE.Mesh(sideWindowGeo, windowMat);
    sideWindowRight.position.set(1.25, 1.2, -0.71);
    sideWindowRight.rotation.y = Math.PI;
    truckGroup.add(sideWindowRight);

    // Headlights (Glowing)
    const lightGeo = new THREE.CircleGeometry(0.15, 32);
    const lightMat = new THREE.MeshBasicMaterial({ color: 0xfef08a }); // Yellow glow

    const lightLeft = new THREE.Mesh(lightGeo, lightMat);
    lightLeft.position.set(2.26, 0.7, 0.4);
    lightLeft.rotation.y = Math.PI / 2;
    truckGroup.add(lightLeft);

    const lightRight = new THREE.Mesh(lightGeo, lightMat);
    lightRight.position.set(2.26, 0.7, -0.4);
    lightRight.rotation.y = Math.PI / 2;
    truckGroup.add(lightRight);

    // Grill
    const grillGeo = new THREE.PlaneGeometry(0.1, 0.4);
    const grill = new THREE.Mesh(grillGeo, darkMat);
    grill.position.set(2.26, 0.5, 0);
    grill.rotation.y = Math.PI / 2;
    truckGroup.add(grill);

    // 3. Wheels
    function createToonWheel(x, z) {
        const wheelGroup = new THREE.Group();

        const tireGeo = new THREE.CylinderGeometry(0.35, 0.35, 0.3, 32);
        tireGeo.rotateZ(Math.PI / 2);
        const tire = new THREE.Mesh(tireGeo, wheelMat);
        tire.castShadow = true;
        addOutline(tire, tireGeo);
        wheelGroup.add(tire);

        const rimGeo = new THREE.CylinderGeometry(0.15, 0.15, 0.31, 32);
        rimGeo.rotateZ(Math.PI / 2);
        const rim = new THREE.Mesh(rimGeo, rimMat);
        wheelGroup.add(rim);

        wheelGroup.position.set(x, 0.35, z);
        return wheelGroup;
    }

    truckGroup.add(createToonWheel(1.5, 0.6)); // Front Left
    truckGroup.add(createToonWheel(1.5, -0.6)); // Front Right
    truckGroup.add(createToonWheel(-1.0, 0.6)); // Rear Left
    truckGroup.add(createToonWheel(-1.0, -0.6)); // Rear Right

    // 4. Cargo Pile - The "Synch" Part
    // Using brand colors instead of random bright colors
    const cargoGroup = new THREE.Group();
    cargoGroup.position.set(-0.5, 1.85, 0);

    // Main Purple Box
    const box1Geo = new THREE.BoxGeometry(0.8, 0.8, 0.8);
    const box1 = new THREE.Mesh(box1Geo, boxPurpleMat);
    box1.position.set(0, 0.4, 0);
    box1.castShadow = true;
    addOutline(box1, box1Geo);
    cargoGroup.add(box1);

    // Tall Teal Box (Contrast)
    const box2Geo = new THREE.BoxGeometry(0.3, 1.2, 1.0);
    const box2 = new THREE.Mesh(box2Geo, boxTealMat);
    box2.position.set(0.6, 0.6, 0.1);
    box2.rotation.z = -0.2;
    box2.castShadow = true;
    addOutline(box2, box2Geo);
    cargoGroup.add(box2);

    // Dark Purple Box
    const box3Geo = new THREE.BoxGeometry(0.6, 0.7, 0.6);
    const box3 = new THREE.Mesh(box3Geo, boxDarkPurpleMat);
    box3.position.set(-0.5, 0.35, 0.3);
    box3.castShadow = true;
    addOutline(box3, box3Geo);
    cargoGroup.add(box3);

    // Small Top Box (White/Grey for balance)
    const box4Geo = new THREE.BoxGeometry(0.4, 0.4, 0.4);
    const box4 = new THREE.Mesh(box4Geo, cabinMat);
    box4.position.set(0, 1.0, 0);
    box4.castShadow = true;
    addOutline(box4, box4Geo);
    cargoGroup.add(box4);

    truckGroup.add(cargoGroup);

    scene.add(truckGroup);

    // Animation Loop
    function animate() {
        requestAnimationFrame(animate);
        controls.update();

        // Gentle floating animation
        truckGroup.position.y = Math.sin(Date.now() * 0.002) * 0.05;

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
