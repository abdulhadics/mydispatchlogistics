<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog');
    }

    public function show($slug)
    {
        $articles = [
            'fuel-prices-2024' => [
                'title' => 'Fuel Prices Outlook for 2024',
                'category' => 'Industry News',
                'date' => 'December 8, 2024',
                'author' => 'Sarah Jenkins',
                'content' => '
                    <p>As we head into 2024, the trucking industry is keeping a close eye on diesel prices. After a volatile year, experts are predicting a stabilization trend, though geopolitical factors remain a wildcard.</p>
                    
                    <h4>Key Factors Influencing Prices</h4>
                    <ul>
                        <li><strong>Global Oil Production:</strong> OPEC+ decisions will continue to play a major role in supply levels.</li>
                        <li><strong>Refining Capacity:</strong> New refinery projects coming online in late 2023 may help ease supply constraints.</li>
                        <li><strong>Economic Demand:</strong> A potential economic slowdown could reduce demand, putting downward pressure on prices.</li>
                    </ul>

                    <h4>How to Prepare</h4>
                    <p>Carriers are advised to lock in fuel surcharges where possible and invest in fuel-efficient technologies. Hedging strategies might also be worth considering for larger fleets.</p>
                    
                    <p>“The key is flexibility,” says industry analyst Mark Doe. “Don’t bank on prices dropping to 2020 levels, but don’t panic buy either. Steady, calculated management is the way forward.”</p>
                '
            ],
            'maximizing-fuel-efficiency' => [
                'title' => 'Maximizing Fuel Efficiency: Tips & Tricks',
                'category' => 'Tips & Tricks',
                'date' => 'November 25, 2024',
                'author' => 'Mike "Diesel" Ross',
                'content' => '
                    <p>Fuel is often the single largest expense for an owner-operator. Saving even a few cents per mile can add up to thousands of dollars by the end of the year. Here are some proven strategies to boost your MPG.</p>

                    <h4>1. Monitor Your Speed</h4>
                    <p>For every mph you drive over 60 mph, fuel efficiency drops by about 0.1 mpg. Slowing down just a little can have a massive impact on your bottom line.</p>

                    <h4>2. Reduce Idling</h4>
                    <p>Idling burns about a gallon of fuel per hour. Invest in an APU (Auxiliary Power Unit) or simply turn off the engine when parked for extended periods.</p>

                    <h4>3. Proper Tire Inflation</h4>
                    <p>Under-inflated tires increase rolling resistance. Check your tire pressure weekly. It’s a simple habit that pays off immediately.</p>

                    <h4>4. Aerodynamics</h4>
                    <p>Ensure your deflectors and fairings are in good condition. Closing the gap between the tractor and trailer can also significantly reduce drag.</p>
                '
            ],
            'dot-regulations-explained' => [
                'title' => 'New DOT Regulations Explained',
                'category' => 'Regulation',
                'date' => 'December 1, 2024',
                'author' => 'Legal Team',
                'content' => '
                    <p>The Department of Transportation (DOT) has released new compliance guidelines for 2024. Staying compliant is not just about avoiding fines; it’s about safety and reputation.</p>

                    <h4>Electronic Logging Devices (ELD) Updates</h4>
                    <p>There are new technical specifications for ELDs to ensure better data transfer accuracy during roadside inspections. Ensure your device software is up to date by January 1st.</p>

                    <h4>Drug and Alcohol Clearinghouse</h4>
                    <p>The "return-to-duty" process has been tightened. Drivers with a violation must complete the follow-up testing plan strictly before being cleared to drive again.</p>

                    <h4>Speed Limiter Proposal</h4>
                    <p>Discussions are ongoing regarding a mandatory speed limiter rule for commercial vehicles. While not yet law, it is gaining traction. We advise fleets to start monitoring speed data now to be prepared.</p>
                '
            ]
        ];

        $article = $articles[$slug] ?? null;

        if (!$article) {
            abort(404);
        }

        return view('blog.show', compact('article'));
    }
}
