import { useRef, useState } from "react";
import SignatureCanvas from "react-signature-canvas";
import { Button } from "@/components/ui/button";
import { Eraser } from "lucide-react";

interface Props {
  onChange: (dataUrl: string) => void;
  value?: string;
}

export const SignaturePad = ({ onChange }: Props) => {
  const sigRef = useRef<SignatureCanvas>(null);
  const [isEmpty, setIsEmpty] = useState(true);

  const handleEnd = () => {
    if (sigRef.current && !sigRef.current.isEmpty()) {
      onChange(sigRef.current.toDataURL("image/png"));
      setIsEmpty(false);
    }
  };

  const clear = () => {
    sigRef.current?.clear();
    onChange("");
    setIsEmpty(true);
  };

  return (
    <div className="space-y-3">
      <div className="rounded-lg border-2 border-dashed border-primary/30 bg-white overflow-hidden">
        <SignatureCanvas
          ref={sigRef}
          penColor="hsl(215, 75%, 22%)"
          canvasProps={{
            className: "w-full h-48 touch-none",
          }}
          onEnd={handleEnd}
        />
      </div>
      <div className="flex items-center justify-between">
        <p className="text-sm text-muted-foreground">
          {isEmpty ? "Assine no espaço acima" : "✓ Assinatura registrada"}
        </p>
        <Button type="button" variant="outline" size="sm" onClick={clear}>
          <Eraser className="h-4 w-4 mr-2" /> Limpar
        </Button>
      </div>
    </div>
  );
};
