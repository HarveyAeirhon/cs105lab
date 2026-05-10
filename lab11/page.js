import React from 'react';

export default function Lab11Pokedex() {
  return (
    <div className="min-h-screen bg-[#0f172a] flex items-center justify-center p-8 font-mono">
      
      <div className="flex items-end max-w-5xl">
        
        <div className="bg-[#dc2626] w-96 h-[34rem] rounded-tl-3xl rounded-bl-3xl border-4 border-[#991b1b] relative p-5 shadow-2xl flex flex-col z-10">
          
          <div className="flex items-start gap-4 mb-6 border-b-2 border-red-800 pb-4">
            <div className="w-20 h-20 rounded-full bg-[#e0f2fe] flex items-center justify-center border-[5px] border-white shadow-[inset_0_0_15px_rgba(0,0,0,0.5)]">
               <div className="w-14 h-14 rounded-full bg-[#38bdf8] shadow-[inset_4px_4px_10px_rgba(255,255,255,0.6)]"></div>
            </div>
            <div className="flex gap-2 pt-2">
              <div className="w-4 h-4 rounded-full bg-red-600 border shadow-sm"></div>
              <div className="w-4 h-4 rounded-full bg-yellow-400 border shadow-sm"></div>
              <div className="w-4 h-4 rounded-full bg-green-500 border shadow-sm"></div>
            </div>
          </div>

          <div className="flex gap-2 mb-6">
            <input 
              type="text" 
              placeholder="SEARCH..." 
              className="px-3 py-1 border-2 border-black uppercase text-xs w-2/3 bg-white outline-none font-bold" 
              readOnly 
            />
            <button className="bg-black text-white px-3 py-1 text-xs font-bold uppercase hover:bg-gray-800 border-2 border-red-500 outline outline-2 outline-black">
              Search
            </button>
          </div>

          <div className="bg-[#cbd5e1] border-x-4 border-y-[1.5rem] border-[#94a3b8] rounded-t-xl rounded-bl-xl rounded-br-[3rem] p-6 flex-grow mb-6 relative">

            <div className="bg-white w-full h-full rounded shadow-inner flex items-center justify-center border-2 border-gray-500 overflow-hidden">
              <span className="text-gray-400 text-xs tracking-widest uppercase">Ready...</span>
            </div>

            <div className="absolute bottom-[-1rem] left-4 w-4 h-4 rounded-full bg-red-600 border border-black shadow-sm"></div>
            <div className="absolute bottom-[-1rem] right-4 flex flex-col gap-1">
              <div className="w-8 h-[2px] bg-gray-600"></div>
              <div className="w-8 h-[2px] bg-gray-600"></div>
              <div className="w-8 h-[2px] bg-gray-600"></div>
            </div>
          </div>

          <div className="flex justify-between items-center px-2">
            <div className="w-12 h-12 rounded-full bg-blue-600 border-[3px] border-black shadow-[inset_-2px_-2px_5px_rgba(0,0,0,0.5)]"></div>
            <div className="flex gap-3 mt-[-2rem]">
              <div className="w-10 h-2 bg-green-500 rounded-full border border-black shadow-sm"></div>
              <div className="w-10 h-2 bg-orange-500 rounded-full border border-black shadow-sm"></div>
            </div>

            <div className="w-24 h-24 relative flex items-center justify-center">
              <div className="absolute w-8 h-full bg-[#1f2937] rounded-sm"></div>
              <div className="absolute h-8 w-full bg-[#1f2937] rounded-sm"></div>
              <div className="w-3 h-3 bg-gray-800 rounded-full z-10 shadow-inner"></div>
            </div>
          </div>
        </div>

        <div className="bg-[#dc2626] w-[22rem] h-[28rem] rounded-br-3xl rounded-tr-md border-4 border-l-0 border-[#991b1b] relative p-6 shadow-2xl flex flex-col justify-end">
          
          <div className="bg-[#4ade80] border-4 border-[#166534] w-full h-32 rounded mb-8 flex items-center justify-center shadow-[inset_0_0_10px_rgba(0,0,0,0.3)]">
            <span className="text-[#064e3b] text-xs font-bold tracking-wider px-4 text-center">WAITING FOR INPUT...</span>
          </div>

          <div className="grid grid-cols-5 gap-2 mb-8">
            {[...Array(10)].map((_, i) => (
              <div key={i} className="w-full h-8 bg-blue-500 border border-black rounded shadow-[inset_-1px_-1px_4px_rgba(0,0,0,0.4)]"></div>
            ))}
          </div>

          <div className="flex justify-between items-center mb-6 px-2">
            <div className="flex gap-2">
              <div className="w-3 h-3 rounded-full bg-gray-800 shadow-sm border border-black"></div>
              <div className="w-3 h-3 rounded-full bg-yellow-400 shadow-sm border border-black"></div>
            </div>
            <div className="flex gap-2">
              <div className="w-10 h-2 bg-gray-800 rounded-full shadow-sm border border-black"></div>
              <div className="w-10 h-2 bg-green-500 rounded-full shadow-sm border border-black"></div>
            </div>
          </div>

          <div className="flex gap-4">
            <div className="w-1/2 h-12 bg-yellow-400 border-2 border-[#b45309] rounded shadow-[inset_-2px_-2px_5px_rgba(0,0,0,0.2)]"></div>
            <div className="w-1/2 h-12 bg-yellow-400 border-2 border-[#b45309] rounded shadow-[inset_-2px_-2px_5px_rgba(0,0,0,0.2)]"></div>
          </div>
        </div>

        <div className="ml-12 text-white max-w-sm mb-16 font-mono">
          <h1 className="text-3xl font-bold text-red-500 mb-4 tracking-wider drop-shadow-md">LABORATORY 11</h1>
        </div>


      </div>
    </div>
  );
}